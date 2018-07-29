<?php

namespace App\Http\Controllers\api;

use App\Libraries\Markdown;
use App\Models\Files_model;
use App\Models\Kyniem;

use App\Models\Options;
use Faker\Provider\File;
use Illuminate\Contracts\Session\Session;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class DataController extends BaseController
{


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

        $markdown = "![Img Family]($link)";
        $return   = ['markdown' => $markdown];

        $file             = new Files_model();
        $file->files_name = basename($link);
        $file->files_path = $link;
        $file->save();

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
                'name'=> $v->kyniem_title,
                'location' =>  $v->kyniem_content,
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