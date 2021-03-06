<?php

namespace App\Http\Controllers;

use App\Entities\Tag;
use App\Models\Kyniem;

use App\Repositories\KyniemRepository;
use App\Repositories\TagsRepository;
use App\Services\OverviewService;
use App\Traits\Cloudinary_trait;
use Carbon\Carbon;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class KyniemController extends Controller {

    use Cloudinary_trait;

    private $kyniem_repository;
    private $tags_repository;

    public function __construct(KyniemRepository $kyniem_repository, TagsRepository $tags_repository) {
        $this->kyniem_repository = $kyniem_repository;
        $this->tags_repository   = $tags_repository;

        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('kyniem.kyniem');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request) {

        $this->validate($request, [
            'keyword' => 'required|string|min:3|max:255'
        ]);

        /** @var string $keyword get variable keyword */
        $keyword = $request->input('keyword');
        $page = $request->input('page');

        Cache::flush();
        //<editor-fold desc="Cache data search">
         $data = Cache::remember(config('configfamily.cache_search_kyniem') . ':' . $keyword, 9000, function () use ($keyword,$page) {
            return Kyniem::search($keyword)
                          ->paginate(null, null, 'page', $page);
        });
        //</editor-fold>

        $data->appends(['keyword' => $keyword]);

        return view('kyniem.search', ['data' => $data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function overview() {

        $data   = new OverviewService();
        $render = $data->getDataYear();

        return view('kyniem.overview', $render);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request) {
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
    public function delete(Request $request) {
        $id     = $request->input('id');
        $kyniem = new Kyniem();
        $kyniem->find($id)
               ->update(['delete_flg' => 1]);

        // Log lại nếu có access
        Log::info('[My Log] Delete kyniem ' . $id);
        Cache::flush();

        return redirect()->route('homepage');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {

        $KyniemService = new KyniemService($this->kyniem_repository);

        if ($KyniemService->save($request)) {

            if ($request->ajax()) {
                return response(['status' => true], 200);
            }

            return redirect()
                ->route('homepage')
                ->with('msgToast', 'Đã lưu thành công');
        } else {
            if ($request->ajax()) {
                return response(['status' => false], 400);
            }

            return redirect()
                ->route('homepage')
                ->with('msgToast', 'Có lỗi xảy ra');
        }


    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function calendar() {
        return view('kyniem.calendar');

    }

    public function detail($id, Request $request) {
        $kyniem_detail = $this->kyniem_repository->get_detail($id);

        //<editor-fold desc="Xu ly next">
        if ($kyniem_detail['data'] == null) {
            if ($request->input('op') == 'next') {
                if ($id > (int) $kyniem_detail['max']) {
                    $id = $kyniem_detail['max'];
                } else {
                    $id = $id + 1;
                }
            } else {
                $id = ($id - 1);
                // if ($id > 0) {
                // }
            }

            return redirect(route('kyniem_detail_id', $id) . "?op=" . $request->input('op'));
        }
        //</editor-fold>

        $dataRender = $this->adaptationDBRender($kyniem_detail);

        return view('kyniem.detail', $dataRender);


    }

    private function adaptationDBRender($data) {
        return [
            'data'  => $data['data'],
            'other' => $data['other']
        ];
    }

    public function showTag($tag){
        $tag = Tag::where('name',$tag)->first();
        if (!isset($tag->kyniems)) {
            return redirect(route('403'));
        }
        $data = $tag->kyniems;

        $data = $this->paginate($data);
        return view('kyniem.search', ['data' => $data]);
    }

    public function paginate($items, $perPage = 15, $page = null)
    {
        $pageName = 'page';
        $page     = $page ?: (Paginator::resolveCurrentPage($pageName) ?: 1);
        $items    = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            [
                'path'     => Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );
    }
}
