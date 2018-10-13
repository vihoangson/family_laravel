<?php

namespace App\Http\Controllers\admin;

use App\Libraries\CloudinaryLib;
use App\Models\Media;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
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

    protected $comment_repository;

    public function __construct(CommentRepository $comment_repository)
    {
        parent::__construct();
        $this->comment_repository = $comment_repository;
    }

    public function index()
    {
        if (!Cache::has('cache_comment')) {
            $data = $this->comment_repository->orderBy('id', 'desc')
                                             ->with("Kyniem")
                                             ->all();
            Cache::forever('cache_comment', $data);
        }
        $all = Cache::get('cache_comment');

        $page    = Input::get('page', 1);
        $perPage = 40;


        $data = new LengthAwarePaginator($all->forPage($page, $perPage), $all->count(), $perPage, $page,
            ['path' => route('comment_manage.index')]);

        return view('admin/commentmange_list')->with('data', $data);
    }


}
