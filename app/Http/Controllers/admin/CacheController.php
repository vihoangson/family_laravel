<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CacheController extends Controller
{

    public function clearCacheOptions()
    {
        Cache::flush();

        return redirect()->back()->with('msgToast','Cache đã được xóa');
    }
}
