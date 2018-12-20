<?php
/**
 * Created by PhpStorm.
 * User: hoang_son
 * Date: 12/19/2018
 * Time: 11:40 AM
 */

namespace App\Http\Controllers;

use App\Models\Kyniem;
use App\Repositories\KyniemRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Validation\ValidatesRequests;

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
        if (!empty($id)) {

            // Update kyniem
            $kyniem = Kyniem::find($request->input('id'));

            // Check exist content
            if ($kyniem == null) {
                throw new \Exception('Don\'t have content');
            }

            $kyniem->kyniem_create = Carbon::createFromFormat('d/m/Y', $request->input('date_create'))
                                           ->format('Y-m-d H:i:s');
        } else {
            // Insert kyniem
            $kyniem = new Kyniem();
        }

        if (true) {
            $kyniem->setAttribute('kyniem_content', $request->input('content'));
            $kyniem->setAttribute('kyniem_title', ($request->input('title') ? $request->input('title') :
                'Happy Family'));
        } else {
            // Không dùng cách này
            $kyniem->kyniem_content = $request->input('content');
            $kyniem->kyniem_title   = ($request->input('title') ? $request->input('title') : 'Happy Family');
            die;
        }

        return $this->kyniem_repository->save_kyniem($kyniem);


    }
}