<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{

    public function clearCache()
    {
        Cache::flush();

        return redirect()->back();
    }
}
