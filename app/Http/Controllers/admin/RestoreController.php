<?php

namespace App\Http\Controllers\admin;

use App\Libraries\CloudinaryLib;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RestoreController extends Controller
{

    public function do_restore(Request $request)
    {
        $this->process_restore($request);

        return redirect()
            ->back()
            ->with('msgToast', 'Đã do_restore db + img from cloud');
    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     * @author hoang_son
     */
    public function process_restore(Request $request)
    {

        self::get_db();


        self::get_imgs();


    }

    /**
     * Lấy file mới nhất trên cloud về
     *
     * @author hoang_son
     */
    public static function get_db()
    {
        if(env('APP_ENV') != 'local'){
            return false;
        }

        if (!file_exists(env('DB_DATABASE'))) {
            CloudinaryLib::downloadLastFileDBInCloud();
        }
    }

    public static function get_imgs()
    {
        CloudinaryLib::do_restore();

    }

}
