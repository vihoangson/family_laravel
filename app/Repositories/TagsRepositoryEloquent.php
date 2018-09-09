<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TagsRepository;
use App\Entities\Tags;
use App\Validators\TagsValidator;

/**
 * Class TagsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TagsRepositoryEloquent extends BaseRepository implements TagsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tags::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
