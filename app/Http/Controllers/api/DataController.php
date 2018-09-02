<?php

namespace App\Http\Controllers\api;

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
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class DataController extends BaseController
{

    use Cloudinary_trait;

    public function __construct() { }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function get_ky_niem(Request $request)
    {
        $kyniem = new Kyniem();
        $data   = $kyniem->where('delete_flg', 0)
                         ->where('show_flg', 1)
                         ->orderBy('id', 'desc')
                         ->limit(10)
                         ->offset($request->input('step'))
                         ->get();
        $return = $data->toArray();

        return response($return);
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function ajax_up_files(Request $request)
    {

        $name        = date('Ymd_Hmi') . "_" . ($request->file('userfile')
                                                        ->getClientOriginalName());
        $path        = $request->file('userfile')
                               ->storeAS('public/images', $name);
        $link_public = str_replace('public', 'storage', $path);

        //<editor-fold desc="resize img">
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

        $link = '/' . $link_public;

        $file             = new Files_model();
        $file->files_name = basename($link);
        $file->files_path = $link;
        $file->save();
        if (file_exists(public_path($link))) {
            if ($response = $this->CloudinaryUploadImg(public_path($link))) {
                $media_id = Media_model::saveCloud($response);
                Img_cloudinary_model::saveCloud(['media_id' => $media_id, 'data' => json_encode($response)]);

                Log::info('Uploaded to cloud: ' . json_encode($response));
            } else {
                Log::error('Can\'t upload to cloud: ' . public_path($link . "sss"));
            }
        }

        $markdown = "![Img Family]($link)";
        $return   = ['markdown' => $markdown];

        return $return;
    }

    public function get_calendar()
    {
        // {
        //     id: 0,
        //     name: 'Google I/O',
        //     location: 'San Francisco, CA',
        //     startDate: new Date(2018, 4, 21),
        //     endDate: new Date(2018, 4, 28)
        // }
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
}