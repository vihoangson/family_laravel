<?php

namespace App\Http\Controllers;

use App\Libraries\Markdown;
use App\Models\Kyniem;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;

class KyniemController extends BaseController {


    public function __construct() { }

    public function index() {
        $m          = new Kyniem();
        $data_first = $m->getHomepage();

        return view('kyniem.kyniem', ['all' => $data_first]);
    }

}