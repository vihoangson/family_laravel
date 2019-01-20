@extends('layouts/template2/layout')
@section('title_page','Family detail content')
@section('body')
@php
//dd($data);
@endphp
    <h1>{{$data->kyniem_title}}</h1>
    {!! $data->kyniem_content_markdown !!}

<div class="row">
    <div class="col-md-6 "><a href="/kyniem/detail/{{$data->id-1}}?op=prev" class="btn btn-default previous">previous</a></div>
    <div class="col-md-6 text-right"><a href="/kyniem/detail/{{$data->id+1}}?op=next" class="btn btn-default next">next</a></div>
</div>


@endsection

@section('custom_js')
    <script>
        // Xử lý bấm ctrl+enter sẽ submit bài viết
        $(document).on("keydown",  function (e) {

            if ((e.keyCode == 37 )) {
                console.log($('.previous').attr('href'));

                $(location).attr('href',$('.previous').attr('href'));
            }
            if ((e.keyCode == 39 )) {
                console.log($('.next').attr('href'));
                $(location).attr('href',$('.next').attr('href'));

            }

            // if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey) {
            //     $("#content").closest('form').submit();
            // }
        });
    </script>
@endsection

@section('custom_css')

@endsection
