<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Comment.
 *
 * @package namespace App\Entities;
 */
class Comment extends Model implements Transformable
{

    use TransformableTrait;
    protected $table = 'comment';
    protected $with  = ['Usercomment'];
    const CREATED_AT = 'comment_create';
    const UPDATED_AT = 'comment_modifie';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['kyniem_id', 'comment_content','comment_users'];

    public function Usercomment()
    {
        return $this->hasOne('App\User', 'id', 'comment_user');

    }
}
