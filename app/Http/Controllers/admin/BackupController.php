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

class BackupController extends Controller {

    public function do_backup() {

        try {

            //<editor-fold desc="Run artisan backup db">
            ob_start();
            Artisan::call('backup_db');
            $string_output = ob_get_clean();
            //</editor-fold>

            //<editor-fold desc="Check result is Done">
            if (!preg_match('/Done/', $string_output)) {
                throw new \Exception('Can\'t backup');
            }

            //</editor-fold>

            return redirect()
                ->back()
                ->with('msgToast', 'Đã backup file db');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('msgToast', 'Backup bị sai');
        }
    }

    public function list_file_db_backup(Request $request) {
        if ($request->input('refresh') == true) {
            Cache::forget('file_db_backup');

            return redirect()
                ->route('list_file_db_backup')
                ->with('msgToast', 'Đã cập nhật file từ cloud');;
        }

        if (!Cache::has('file_db_backup')) {
            $file_db_backup = CloudinaryLib::getAllRaw();
            Cache::forever('file_db_backup', $file_db_backup);
        }
        $file_db_backup = Cache::get('file_db_backup');

        return view('admin.list_file_db_backup', ['data' => $file_db_backup]);
    }

}
