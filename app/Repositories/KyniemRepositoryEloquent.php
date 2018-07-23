<?php

namespace App\Repositories;

use App\Models\Options;
use Prettus\Repository\Eloquent\BaseRepository;

class KyniemRepositoryEloquent  extends BaseRepository implements KyniemRepository
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

    public function getAllKyniemByDay()
    {
        $m = new Options;
        $n = $m->find(1);
        $k = $this->all();
        return $k;
        return $n->toJson() ;
    }
}
