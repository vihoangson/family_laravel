<?php

namespace App\Http\Controllers\admin;

use App\Libraries\CommonLib;
use App\Libraries\Markdown;
use App\Models\Kyniem;

use App\Models\Options;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\View;

class ReportController extends Controller {


    public function __construct() { parent::__construct(); }

    public function index() {
        $string = CommonLib::report();

        $array_options = $string;

        View::share('array_options', $array_options);

        return view('admin.report');
    }


}