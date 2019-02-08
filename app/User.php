<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','permission'
    ];
    public $fields = [
        'avatar'
    ];

    protected $appends = ['avatar'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function info(){
        return $this->hasMany('App\Entities\Userinfo');
    }

    public function getAvatarAttribute(){
        return $this->info->where('info_key','avatar')->first()->info_value;
    }
}
