<?php

namespace App\Models;

use App\Libraries\Markdown;
use Illuminate\Database\Eloquent\Model;

class Files_model extends Model
{

    protected $table   = 'files';
    protected $guarded = [];

    public $timestamps = false;


}