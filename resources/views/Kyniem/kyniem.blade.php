@extends('layouts/template2/layout')
@section('title_page','Trang chủ')
@section('title_body','Trang chủ')

@section('body')
    <div id='wallmessages'>
        <div class="message-item hidden" data-step="-1">
            <h2 class="block-title"></h2>
            <div class="block-content"></div>
            <hr>
        </div>
    </div>
    <button class="loadmore btn btn-primary">Load more</button>
@endsection

@section('custom_js')
    <script src="/assets/js/autoload_homepage.js"></script>
@endsection

@section('custom_css')
@endsection
