<?php

namespace App\Http\Controllers;

use App\Libraries\Markdown;
use App\Models\Kyniem;

use App\Models\Options;
use App\Repositories\KyniemRepository;
use App\Traits\Cloudinary_trait;
use Carbon\Carbon;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\View;

class KyniemController extends Controller
{
    use Cloudinary_trait;

    private $kyniem_repository;

    public function __construct(KyniemRepository $kyniem_repository)
    {
        $this->kyniem_repository = $kyniem_repository;
        parent::__construct();
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
        $m = new Carbon();
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
        $id = ($request->input('id'));
        if (!empty($id)) {
            $kyniem                = Kyniem::find($request->input('id'));
            $kyniem->kyniem_create = Carbon::createFromFormat('d/m/Y', $request->input('date_create'))
                                           ->format('Y-m-d H:i:s');
        } else {
            $kyniem = new Kyniem();
        }
        $kyniem->kyniem_content = $request->input('content');
        $kyniem->kyniem_title   = ($request->input('title') ? $request->input('title') : 'Happy Family');

        $kyniem->save();

        return redirect()->route('homepage');
    }

    public function calendar()
    {
        return view('kyniem.calendar');

    }
}