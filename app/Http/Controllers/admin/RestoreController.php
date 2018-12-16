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
        die;
        Artisan::call('backup_db');

        return redirect()
            ->back()
            ->with('msgToast', 'Đã backup file db');
    }

    public function process_restore(Request $request)
    {
        //todo: Get db
        $this->get_db();
        //todo: Get images
        $this->get_imgs();
    }

    private function get_db() {
        $data = CloudinaryLib::getAllRaw();
        dd($data);

    }

    private function get_imgs() {

        $data = CloudinaryLib::getAllImage();

    }

}
