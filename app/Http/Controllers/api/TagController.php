<?php

namespace App\Http\Controllers\api;

use App\Entities\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\BaseController;

class TagController extends Controller {

    use BaseController;

    public function __construct() {
        $this->model('App\Entities\Tag');
    }
}
