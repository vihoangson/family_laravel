@extends('layouts/template2/layout')
@section('title_page','Trang chủ')

@section('body')
    @foreach($img_year as $key => $img_year)
        <h2>{{$key}}</h2>

        <div class="row">
            @foreach($img_year as $key_2 => $img_2)
                <div class="col-md-3 box-img-yearly">
                    <div class="img-boxer"><img class="thumbnail" src="{{$img_2['url']}}"></div>
                    <div class="title-img">{{$img_2['title']}}</div>
                    <hr>
                </div>

            @endforeach
        </div>
    @endforeach

@endsection

@section('custom_js')
    <script>
        function equalHeight() {
            var $colClass = $('.img-boxer'), //class name of columns
                heights = $colClass.map(function () { //get height of all columns, pass it to an array (heights)
                    return $(this).height();
                }).get();

            $colClass.height(Math.max.apply(null, heights));

            $('.img-boxer img').hide();
            onImgLoad('.img-boxer img', function(){
                $(this).fadeIn(700);
            });
        }

        $(document).ready(function(){
            equalHeight();
        });
    </script>

@endsection

@section('custom_css')
    <style>
        img.thumbnail {
            width: 100%;
        }
        .img-boxer {
            display: table-cell;
            vertical-align: middle;
        }
        .title-img{
            text-align: center;
        }
    </style>
@endsection
