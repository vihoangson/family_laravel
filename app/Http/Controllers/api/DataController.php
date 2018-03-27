<?php

namespace App\Http\Controllers\api;

use App\Libraries\Markdown;
use App\Models\Kyniem;

use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;

class DataController extends BaseController {


    public function __construct() { }

    public function index(Request $request) {
        echo $request->input('sss');
        //return response([1,2,3,4,5]);
    }


    public function get_ky_niem(Request $request){
        $kyniem = new Kyniem();

        //Session::flash('current_year', 2018);
        //$year = Session::flash('current_year');
        $year = 2018;
        $data   = $kyniem->where('kyniem_create', 'like', '%'.$year.'%')
                         ->orderBy('id')
                         ->limit(10)
                         ->offset($request->input('step'))
                         ->get();
        $return = $data->toArray();

        return response($return);
    }
}