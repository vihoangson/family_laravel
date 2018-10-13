<?php

namespace App\Http\Controllers\admin;

use App\Libraries\CloudinaryLib;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

    // |        | GET|HEAD  | admin/comment_manage                       | comment_manage.index   | App\Http\Controllers\admin\CommentManangeController@index              | web,auth                              |
    // |        | POST      | admin/comment_manage                       | comment_manage.store   | App\Http\Controllers\admin\CommentManangeController@store              | web,auth                              |
    // |        | GET|HEAD  | admin/comment_manage/create                | comment_manage.create  | App\Http\Controllers\admin\CommentManangeController@create             | web,auth                              |
    // |        | DELETE    | admin/comment_manage/{comment_manage}      | comment_manage.destroy | App\Http\Controllers\admin\CommentManangeController@destroy            | web,auth                              |
    // |        | GET|HEAD  | admin/comment_manage/{comment_manage}      | comment_manage.show    | App\Http\Controllers\admin\CommentManangeController@show               | web,auth                              |
    // |        | PUT|PATCH | admin/comment_manage/{comment_manage}      | comment_manage.update  | App\Http\Controllers\admin\CommentManangeController@update             | web,auth                              |
    // |        | GET|HEAD  | admin/comment_manage/{comment_manage}/edit | comment_manage.edit    | App\Http\Controllers\admin\CommentManangeController@edit               | web,auth

class CommentManangeController extends Controller
{
    public function __construct() {

    }

    public function index(){
echo 123;
    }


}
