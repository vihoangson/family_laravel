<?php

namespace App\Http\Controllers;

use App\Models\Options;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;


class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        if (!Cache::has('cache_option')) {
            $data_options = Options::where('option_key', 'not like', '"%cache%e"')
                                   ->get()
                                   ->toArray();
            foreach ($data_options as $key => $value) {
                if (!Cache::has("options_" . $value['option_key'])) {
                    Cache::forever("options_" . $value['option_key'], $value['option_content']);
                }
            }
            Cache::put('cache_option',true);
        }
    }
}
