<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class KyniemReponsitoryEloquent extends BaseRepository implements KyniemRepository
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
}
