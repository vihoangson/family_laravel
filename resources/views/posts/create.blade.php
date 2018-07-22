@extends('layouts/template2/layout')
@section('title_page','Post')
@section('title_body','Post')

@section('body')
    <form action="/post" method="post">
        {!! csrf_field() !!}
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div>
            <input name="title" class="form-control" value="{{Request::old('title')}}">
        </div>
        <div>
            <input name="content" class="form-control"  value="{{Request::old('content')}}">
        </div>
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
    <hr>
@endsection

@section('custom_js')

@endsection

@section('custom_css')
@endsection

