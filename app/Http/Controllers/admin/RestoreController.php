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
        //todo: Get db
        $this->get_db();

        //todo: Get images
        $this->get_imgs();


    }

    /**
     * Lấy file mới nhất trên cloud về
     *
     * @author hoang_son
     */
    private function get_db()
    {
        if (!file_exists(env('DB_DATABASE'))) {
            CloudinaryLib::downloadLastFileDBInCloud();
        }
    }

    private function get_imgs()
    {
        $data = \Cache::forget('dataimgcloud');
        if (!\Cache::has('dataimgcloud')) {
            $data = CloudinaryLib::getImageInFolder('my_folder/img_family');
            \Cache::forever('dataimgcloud', $data);
        }
        $data = \Cache::get('dataimgcloud');

        //Set time out 120s
        set_time_limit(1200);

        $path = storage_path('app/public/images/');
        @mkdir($path);

        foreach ($data as $value) {
            $file_path = $path . basename($value['url']);

            // Nếu file không tồn tại thì down về
            if (!file_exists($file_path)) {
                $data_img = file_get_contents($value['url']);
                if(!file_put_contents($file_path, $data_img)){
                    throw new \Exception('Can\'t wirte file');
                }
            }
        }
        \Cache::forget('dataimgcloud');
    }

}
