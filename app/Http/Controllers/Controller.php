<?php

namespace App\Http\Controllers;

use App\Models\Options;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $data_options = Options::where('option_key', 'not like', '"%cache%e"')
                               ->get()
                               ->toArray();

        foreach ($data_options as $key => $value) {
            View::share("options_" . $value['option_key'], $value['option_content']);
        }
        //dd(get_defined_vars());
    }
}
