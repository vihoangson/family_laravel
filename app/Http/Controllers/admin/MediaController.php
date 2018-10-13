<?php

namespace App\Http\Controllers\admin;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MediaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Media::paginate(config('common.per_page'));

        return view('admin/medialist')->with('data', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Media::truncate();
        $files = Storage::allFiles();
        foreach ($files as $file) {
            if (!preg_match('/\.(png|jpg|gif)/', $file)) {
                continue;
            }
            $file = str_replace('public/', '/storage/', $file);
            Media::insert([
                'files_name' => 'image',
                'files_path' => $file
            ]);
        }

        return redirect(route('media.index'))->with('msgToast', 'Đã cập nhật hình');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media $media
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media $media
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Media        $media
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media $media
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
