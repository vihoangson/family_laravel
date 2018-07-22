<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CelebrationRepository;
use App\Models\Celebration;
use App\Validators\CelebrationValidator;

/**
 * Class CelebrationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CelebrationRepositoryEloquent extends BaseRepository implements CelebrationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Celebration::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CelebrationValidator::class;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getSpecial(){
        return Celebration::all();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
