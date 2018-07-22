@extends('layouts/template2/layout')
@section('title_page','Post')
@section('title_body','Post')

@section('body')
    @foreach($celebrations as $celebration )
        <div>{{$celebration->c_date}}</div>
        <div>{{$celebration->description}}</div>
        <hr>
    @endforeach
@endsection

@section('custom_js')

@endsection

@section('custom_css')
@endsection
