<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait BaseController {

    public $model;

    public function model($nameModel){
        $this->model = new $nameModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $data = $this->model->all();

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $data       = $this->model;
            $rq         = $request->input();
            $data->name = $rq['name'];
            $data->save();

            return $data;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $data = $this->model->find($id);

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = $this->model->find($id);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $data       = $this->model->find($id);
            $rq         = $request->input();
            $data->name = $rq['name'];
            $data->save();

            return $data;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        return $this->model->find($id)->delete()?'true':'false';
    }
}
