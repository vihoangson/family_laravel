@extends('layouts/template2/layout')
@section('body')
    @foreach($array_options as $k => $v)
        <div>
            <label>{{$k}}</label>
            <input type="text" value="{{$v['value']}}">
        </div>
    @endforeach
@endsection