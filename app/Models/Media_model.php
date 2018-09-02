<?php

namespace App\Models;

use App\Libraries\Markdown;
use Illuminate\Database\Eloquent\Model;

class Media_model extends Model
{

    protected $table   = 'media';
    protected $guarded = [];

    public $timestamps = false;

    public static function saveCloud($data)
    {

        $data_insert = [
            'files_path' => $data['url'],
            'files_name' => $data['original_filename'],
            'files_size' => $data['width'].'x'.$data['height'],
            'files_type' => $data['format'],
            'files_cloud_url' => $data['url'],
        ];

        return self::insertGetId($data_insert);
    }


}