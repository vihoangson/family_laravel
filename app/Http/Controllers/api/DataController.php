<?php

namespace App\Http\Controllers\api;

use App\Entities\Comment;
use App\Http\Controllers\admin\RestoreController;
use App\Libraries\Markdown;
use App\Models\Files_model;
use App\Models\Img_cloudinary_model;
use App\Models\Kyniem;

use App\Models\Media_model;
use App\Models\Options;
use App\Traits\Cloudinary_trait;
use Faker\Provider\File;
use Illuminate\Contracts\Session\Session;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller as BaseController;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class DataController extends BaseController
{

    use Cloudinary_trait;

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
    }


    /**
     * Lấy thông tin kỷ niệm hiện tra trang chủ
     *
     * @param Request $request
     *
     * @api /api/getkyniem
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function get_ky_niem(Request $request)
    {

        $step = $request->input('step');

        $data = $this->get_data_kyniem($step);

        $return = $data->toArray();

        return response($return);
    }

    /**
     * Lấy thông tin kỷ niệm hiện tra trang chủ
     *
     * @param Request $request
     *
     * @api /api/getkyniem
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function get_ky_niem_html(Request $request)
    {
        $step = $request->input('step');

        $data = $this->get_data_kyniem($step);

        echo '<base href="' . env('APP_URL') . '">';

        foreach ($data as $value) {
            echo Markdown::defaultTransform($value->kyniem_content);
        }
    }

    public function ajax_up_many_files(Request $request){
        $request_one = new Request();
        $request_one->initialize(['userfile'=>$request->input('')]);
        $this->ajax_up_files($request_one);
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function ajax_up_files(Request $request)
    {
        $file_input = $request->file('userfile');

        //<editor-fold desc="Upload hình">
        $name = date('Ymd_Hmi') . "_" . ($file_input
                                                 ->getClientOriginalName());
        $path = $file_input
                        ->storeAS('public/images', $name);
        //</editor-fold>

        //<editor-fold desc="Resize img">

        $link_public = str_replace('public', 'storage', $path);

        $manager = new ImageManager();
        $m       = $manager->make(public_path($link_public));

        $max_size = Options::where('option_key', 'max_size_img')
                           ->get()
                           ->first()->option_content;
        if ($m->mime() != 'image/gif') {
            if ($m->width() > $max_size) {
                $m->resize($max_size, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $m->save();
            }
        }
        //</editor-fold>

        //<editor-fold desc="Save thông tin file vào db">
        $link             = '/' . $link_public;
        $file             = new Files_model();
        $file->files_name = basename($link);
        $file->files_path = $link;
        $file->created_at = date('Y-m-d H:i:s');
        $file->save();
        //</editor-fold>

        //<editor-fold desc="Upload to clound">
        if (file_exists(public_path($link))) {

            //<editor-fold desc="Set path in cloud">
            if ($request->input('path') == null) {
                $path_in_cloud = config('configfamily.folder_in_cloud');
            } else {
                $path_in_cloud = $request->input('path');
            }
            //</editor-fold>

            if ($response = $this->CloudinaryUploadImg(public_path($link), $path_in_cloud )) {
                $media_id = Media_model::saveCloud($response);
                Img_cloudinary_model::saveCloud(['media_id' => $media_id, 'data' => json_encode($response)]);

                Log::info('Uploaded to cloud: ' . json_encode($response));
            } else {
                Log::error('Can\'t upload to cloud: ' . public_path($link . "sss"));
            }
        }
        //</editor-fold>

        //<editor-fold desc="Trả thông tin ra response">
        $markdown = "![Img Family]($link)";
        $return   = ['markdown' => $markdown];

        //</editor-fold>

        return $return;
    }

    /**
     * Lấy thông tin lịch
     *
     * @return \Illuminate\Http\JsonResponse
     * @author hoang_son
     */
    public function get_calendar()
    {
        $kn = Kyniem::all();
        foreach ($kn as $v) {
            $json[] = [
                'id'       => $v->id,
                'name'     => $v->kyniem_title,
                'location' => $v->kyniem_content,
                // 'name'     => "1",
                // 'location' => "1",
                'year'     => $v->kyniem_create->format('Y'),
                'month'    => $v->kyniem_create->format('m'),
                'date'     => $v->kyniem_create->format('d'),
            ];
        }

        return response()->json($json);
    }

    public function insert_comment(Request $request)
    {
        $comment_kyniem_id  = $request->input('comment_kyniem_id');
        $comment_content    = $request->input('comment_content');
        $comment_user       = Auth::id();
        $c                  = new Comment;
        $c->kyniem_id       = $comment_kyniem_id;
        $c->comment_content = $comment_content;
        $c->comment_user    = $comment_user;

        $c->save();

        Cache::forget('cache_comment');

        return response(Comment::where('kyniem_id', $comment_kyniem_id)
                               ->orderByDesc('id')
                               ->get()
                               ->toArray());
    }

    private function get_all_key_cache()
    {

        $storage    = Cache::getStore(); // will return instance of FileStore
        $filesystem = $storage->getFilesystem(); // will return instance of Filesystem
        $dir        = (Cache::getDirectory());
        $keys       = [];
        foreach ($filesystem->allFiles($dir) as $file1) {

            if (is_dir($file1->getPath())) {

                foreach ($filesystem->allFiles($file1->getPath()) as $file2) {
                    $keys = array_merge($keys,
                        [$file2->getRealpath() => unserialize(substr(\File::get($file2->getRealpath()), 10))]);
                }
            } else {

            }
        }
        dd($keys);
    }

    /**
     * @param int $step Step offset
     *
     * @return Kyniem[]|\Illuminate\Database\Eloquent\Collection
     */
    private function get_data_kyniem($step)
    {
        $key_of_cache = config('configfamily.namecachedata') . ':' . $step;

        if (!Cache::has($key_of_cache)) {
            $data = Kyniem::where('delete_flg', 0)
                          ->where('show_flg', 1)
                          ->orderBy('id', 'desc')
                          ->limit(config('common.per_page', 10))
                          ->offset($step)
                          ->get();
            Cache::forever($key_of_cache, $data);
        } else {
            $data = Cache::get($key_of_cache);
        }

        return $data;
    }
}