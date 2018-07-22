<?php

namespace App\Http\Controllers;

use App\Libraries\Markdown;
use App\Models\Kyniem;

use App\Models\Options;
use App\Repositories\KyniemReponsitoryInterface;
use App\Repositories\KyniemRepository;
use App\Repositories\UserReponsitory;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\View;

class KyniemController extends Controller
{


    public function __construct(KyniemReponsitoryInterface $k) {
        parent::__construct();
        $n = $k->all();
        dd($n);
    }

    public function index()
    {

        return view('kyniem.kyniem');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function overview()
    {
        $m = new UserReponsitory();
        $n = $m->get_all_ky_niem();
        dd($n);

        return view('kyniem.overview');
    }

    public function edit(Request $request)
    {
        $id     = $request->input('id');
        $kyniem = new Kyniem();
        $data   = $kyniem->find($id);

        return view('kyniem.edit', ['data' => $data]);
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $id     = $request->input('id');
        $kyniem = new Kyniem();
        $kyniem->find($id)
               ->update(['delete_flg' => 1]);

        return redirect()->route('homepage');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $kyniem                 = new Kyniem();
        $kyniem->kyniem_content = $request->input('content');
        $kyniem->kyniem_title   = ($request->input('title') ? $request->input('title') : 'Happy Family');
        $kyniem->save();
        View::share('name', 'Steve');

        return redirect()->route('homepage');
    }
}