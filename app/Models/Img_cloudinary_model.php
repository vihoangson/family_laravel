<?php

namespace App\Models;

use App\Libraries\Markdown;
use Illuminate\Database\Eloquent\Model;

class Img_cloudinary_model extends Model
{

    protected $table   = 'img_cloudinary';
    protected $guarded = [];

    public $timestamps = false;

    public static function saveCloud($data)
    {
        self::insert($data);
    }


}