<?php

namespace App\Repositories;

use App\Models\Kyniem;
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

    public function save_kyniem(Kyniem $kyniem)
    {
        try {
            $kyniem->save();
        } catch (ValidatorException $e) {
            echo $e->getMessage();
            die;
        }
    }
}
