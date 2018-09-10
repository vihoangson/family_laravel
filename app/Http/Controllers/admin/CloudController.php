<?php

namespace App\Http\Controllers\admin;

use App\Libraries\CloudinaryLib;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CloudController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!Cache::has('image_cloud')) {
            $this->Recache_cloud_img();
        }
        $data = Cache::get('image_cloud');

        return view('admin/cloudindex')->with('data', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->Recache_cloud_img();

        return redirect()
            ->back()
            ->with('msgToast', 'Đã cập nhật hình');
    }

    private function Recache_cloud_img(){
        Cache::forget('image_cloud');
        $data = CloudinaryLib::getAllImage();
        Cache::forever('image_cloud', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media $media
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media $media
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media) {
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
    public function update(Request $request, Media $media) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media $media
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media) {
        //
    }
}
