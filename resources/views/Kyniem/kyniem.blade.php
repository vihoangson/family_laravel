@extends('layouts/template1')
@section('title_page','Trang chủ')

@section('body')
    <div id='wallmessages'>
        <div class="message-item" data-step="-1">
            <h2 class="block-title"></h2>
            <div class="block-content"></div>
        </div>
    </div>
    <button class="loadmore">Load more</button>
@endsection

@section('custom_js')
    <script src="/assets/js/autoload_homepage.js"></script>
@endsection

@section('custom_css')
@endsection
