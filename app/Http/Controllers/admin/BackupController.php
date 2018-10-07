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

    public function do_backup(){
        Artisan::call('backup_db');
        return redirect()
            ->back()
            ->with('msgToast', 'Đã backup file db');
    }

}
