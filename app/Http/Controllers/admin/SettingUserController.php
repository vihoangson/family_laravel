<?php

namespace App\Http\Controllers\admin;

use App\Entities\Userinfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SettingUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $array_settings = [
            'avatar'                => [
                'type' => 'image',
            ],
        ];
        foreach ($array_settings as $k => &$v) {
            $m = @Auth::user()->info->where('info_key',$k)->first()->info_value;
            if ($m) {
                $v['value'] = $m;
            } else {
                $v['value'] = isset($v['default'])?$v['default']:"";
            }
        }
        unset($v);

        View::share('array_settings', $array_settings);

        return view('admin.setting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $m = Auth::user()->info;
        foreach ($request->input() as $key => $v){
            $k = $m->where('info_key',$key)->first();
            if($k){
                $k->info_value= $v;
                $k->save();
            }else{
                if($key == '_token'){
                    continue;
                }
                $k = new Userinfo;
                $k->setAttribute('info_key',$key);
                $k->setAttribute('info_value',$v);
                $k->setAttribute('user_id',Auth::id());
                $k->save();
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
