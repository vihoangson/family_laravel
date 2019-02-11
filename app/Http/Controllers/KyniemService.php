<?php
/**
 * Created by PhpStorm.
 * User: hoang_son
 * Date: 12/19/2018
 * Time: 11:40 AM
 */

namespace App\Http\Controllers;

use App\Entities\Tag;
use App\Models\Kyniem;
use App\Repositories\KyniemRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class KyniemService {

    use ValidatesRequests;

    public $kyniem_repository;

    public function __construct(KyniemRepository $kyniem_repository) {
        $this->kyniem_repository = $kyniem_repository;
    }

    /**
     * @param $request
     *
     * @return bool
     * @throws \Exception
     */
    public function save($request) {

        // Validate nội dung
        $this->validate($request, [
            'content' => 'required',
        ]);

        $id = ($request->input('id'));

        //<editor-fold desc="Kiểm tra có tồn tại thực thể hay không">
        if (!empty($id)) {
            //<editor-fold desc="Có thực thể">
            // Update kyniem
            $kyniem = Kyniem::find($request->input('id'));

            // Check exist content
            if ($kyniem == null) {
                throw new \Exception('Don\'t have content');
            }

            $kyniem->kyniem_create = Carbon::createFromFormat('d/m/Y', $request->input('date_create'))
                                           ->format('Y-m-d H:i:s');
            //</editor-fold>
        } else {
            //<editor-fold desc="Không có sắn thực thể phải tạo mới">
            // Insert kyniem
            $kyniem = new Kyniem();
            //</editor-fold>
        }
        //</editor-fold>

        //<editor-fold desc="Set attribute for object">
        $kyniem->setAttribute('kyniem_auth', Auth::id());
        $kyniem->setAttribute('kyniem_content', $request->input('content'));
        $kyniem->setAttribute('kyniem_title', ($request->input('title') ? $request->input('title') :
            'Happy Family'));
        //</editor-fold>

        //<editor-fold desc="Save entity">
        $this->kyniem_repository->save_kyniem($kyniem);
        //</editor-fold>

        //<editor-fold desc="Add tag for entity">
        $tagsName = $this->kyniem_repository->getTagsInContent($kyniem);
        $tagsName = array_unique($tagsName);

        if (isset($tagsName) && count($tagsName) > 0) {
            foreach ((array) $tagsName as $v) {
                if($v != ''){
                    $t  = Tag::firstOrCreate(['name'=>$v]);
                    $kyniem->tags()->syncWithoutDetaching($t);
                }
            }
        }
        //</editor-fold>

        return true ;


    }
}