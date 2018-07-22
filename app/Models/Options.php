<?php

namespace App\Models;

use App\Libraries\Markdown;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{

    protected $table   = 'options';
    protected $guarded = [];

    const CREATED_AT = 'option_create';
    const UPDATED_AT = 'option_modifie';


}