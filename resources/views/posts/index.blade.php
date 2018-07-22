@extends('layouts/template2/layout')
@section('title_page','Post')
@section('title_body','Post')

@section('body')
    @foreach($posts as $post )
        <div>{{$post->title}}</div>
        <div>{{$post->content}}</div>
        <hr>
    @endforeach
@endsection

@section('custom_js')

@endsection

@section('custom_css')
@endsection
