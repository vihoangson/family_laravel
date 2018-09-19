<?php

namespace App\Http\Controllers;

use App\Models\Options;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Controller constructor.
     */
    public function __construct()
    {

        $this->set_cache_filter_text_simsimi();

        if (!Cache::has('cache_option')) {
            $data_options = Options::where('option_key', 'not like', '"%cache%e"')
                                   ->get()
                                   ->toArray();
            foreach ($data_options as $key => $value) {
                if (!Cache::has("options_" . $value['option_key'])) {
                    Cache::forever("options_" . $value['option_key'], $value['option_content']);
                }
            }
            Cache::put('cache_option', true);
        }

    }

    private function set_cache_filter_text_simsimi()
    {
        $filter_text = Cache::get('filter_text', config('AI.answers.filter_text'));
        Config::set('AI.answers.filter_text', $filter_text);
    }

    protected function set_cache_filter_text($filter_number = 0.6)
    {
        Cache::forever('filter_text', $filter_number);
        $this->set_cache_filter_text_simsimi();
    }
}
