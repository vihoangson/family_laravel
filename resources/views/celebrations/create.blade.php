@extends('layouts/template2/layout')
@section('title_page','Post')
@section('title_body','Post')

@section('body')
    <form action="/celebrations" method="post">
        {!! csrf_field() !!}
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div>
            <input name="c_date" class="form-control" value="{{Request::old('c_date')}}">
        </div>
        <div>
            <input name="description" class="form-control"  value="{{Request::old('description')}}">
        </div>
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
    <hr>
@endsection

@section('custom_js')

@endsection

@section('custom_css')
@endsection

