<?php

namespace App\Models;

use App\Libraries\Markdown;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Kyniem extends Model
{

    protected $table   = 'kyniem';
    protected $guarded = [];
    protected $appends = ['kyniem_content_markdown','date_format'];

    const CREATED_AT = 'kyniem_create';
    const UPDATED_AT = 'kyniem_modifie';

    public static function search($keyword) {
        $return = self::orWhere('kyniem_content', 'like', '%'.$keyword.'%')->orWhere('kyniem_title', 'like', '%'.$keyword.'%')->orderByDesc('id')->with('User');
        return $return;
    }

    public function getKyniemContentAttribute($value)
    {
        return $value;
    }

    public function getKyniemContentMarkdownAttribute()
    {
        return Markdown::defaultTransform($this->kyniem_content);
    }


    public function User()
    {
        return $this->hasOne('App\User','id','kyniem_auth');
    }


    public function getDateFormatAttribute(){

        return Carbon::createFromTimeString($this->kyniem_create);
    }

    public function getHomepage()
    {
        return $this->orderBy('id', 'desc')
                    ->limit(10)
                    ->get();
    }

}