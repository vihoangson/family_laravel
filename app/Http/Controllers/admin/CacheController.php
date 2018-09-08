<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CacheController extends Controller
{

    public function clearCache()
    {
        Cache::flush();

        Session::flash('msgToast','Cache đã được xóa');
        return redirect()->back();
    }
}
