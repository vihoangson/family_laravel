<?php

namespace App\Repositories;

use App\Models\Kyniem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class KyniemRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\Kyniem";
    }

    /**
     * @param Kyniem $kyniem
     *
     * @return bool
     */
    public function save_kyniem(Kyniem $kyniem)
    {
        try {
            $kyniem->save();

            // Xóa cache
            Cache::flush();

        } catch (ValidatorException $e) {
            echo $e->getMessage();
            die;
        }

        return true;
    }

    public function get_detail($id) {
        return [
            'data' => Kyniem::find($id),
            'max' => DB::table('kyniem')->max('id'),
        ];

    }
}
