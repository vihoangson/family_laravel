<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment.
 *
 * @package namespace App\Entities;
 */
class Userinfo extends Model
{
    protected $fillable = ['avatar'];

    public function getAvatarAttribute(){
        return $this->where('info_key','avatar')->first()->info_value;
    }
}
