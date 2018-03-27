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

        return view('kyniem.kyniem');
    }

    public function overview() {
        return view('kyniem.overview');
    }

    public function store(Request $request){
        $kyniem = new Kyniem();
        $kyniem->kyniem_content = $request->input('content');
        $kyniem->kyniem_title = ($request->input('title')?$request->input('title'):'Happy Family');
        $kyniem->save();
        return redirect()->route('homepage');
    }
}