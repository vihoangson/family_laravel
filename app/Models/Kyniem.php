<?php

namespace App\Models;

use App\Libraries\Backgroud;
use App\Libraries\CommonLib;
use App\Libraries\Markdown;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property string kyniem_title
 * @property string kyniem_content
 * @property string kyniem_content_markdown
 * @property string kyniem_images
 * @property Carbon kyniem_create
 * @property Carbon kyniem_modifie
 * @property string kyniem_auth
 * @property int delete_flg
 * @property int status
 * @property int show_flg
 */
class Kyniem extends Model
{

    protected $table   = 'kyniem';
    protected $guarded = ['kyniem_content'];
    protected $appends = ['kyniem_content_markdown','date_format'];
    protected $with = ['Comment'];

    public $fields = [
        'id',
        'kyniem_title',
        'kyniem_content',
        'kyniem_images',
        'kyniem_create',
        'kyniem_modifie',
        'kyniem_auth',
        'delete_flg',
        'status',
        'show_flg',
    ];

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

    /**
     * Convert thuoc tinh tu markdown ra html
     *
     * @return mixed
     * @author hoang_son
     */
    public function getKyniemContentMarkdownAttribute()
    {
        $this->kyniem_content = Backgroud::filter($this->kyniem_content);
        $this->kyniem_content = CommonLib::filterSmile($this->kyniem_content);
        return Markdown::defaultTransform($this->kyniem_content);
    }

    public function Comment(){
        return $this->hasMany('App\Entities\Comment','kyniem_id','id')->orderByDesc('id');
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