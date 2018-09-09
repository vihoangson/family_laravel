<?php

namespace App\Repositories;

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

    public function save_kyniem($kyniem)
    {
        try {
            $this->create(['kyniem_title' => $kyniem->kyniem_title, 'kyniem_content' => $kyniem->kyniem_content]);
        } catch (ValidatorException $e) {
            echo $e->getMessage();
            die;
        }
    }
}
