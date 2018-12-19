@extends('layouts/template2/layout')
@section('title_page','Tìm kiếm')


@section('body')
    {{ $data->links() }}

    @foreach($data as $m)

        <article class="post post-large">
            <div class="post-date">
                <span class="day">{{$m->date_format->format('d')}}</span>
                <span class="month">{{$m->date_format->format('m/Y')}}</span>
            </div>

            <div class="post-content">
                <h2><a href="blog-post.html">{{$m->kyniem_title}}</a></h2>
                {!! $m->kyniem_content_markdown !!}
                <div class="post-meta ">
                    <span><i class="fa fa-user"></i> By <a href="#">{{@$m->user->name}}</a> </span>
                    <span><i class="fa fa-tag"></i> <a href="#">Duis</a>, <a href="#">News</a> </span>
                    <span><i class="fa fa-comments"></i> <a href="#">12 Comments</a></span>
                    <a href="blog-post.html" class="btn btn-xs btn-primary pull-right hidden">Read more...</a>
                </div>

            </div>
        </article>
        <hr>
    @endforeach
    {{ $data->links() }}

@endsection

@section('custom_js')

    <script src="http://family.vn/asset/js/Magnific-Popup-master/dist/jquery.magnific-popup.js"></script>
    <script src="/assets/bower_components/jquery-form/jquery.form.js"></script>
    <script src="/assets/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
    <script src="/assets/bower_components/Snarl/dist/snarl.min.js"></script>
    <script src="/assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/bower_components/blueimp-file-upload/js/jquery.fileupload.js"></script>
    <script src="/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <script src="/assets/js/autoload_homepage.js"></script>
    <script src="/assets/js/typing.js"></script>
    <script src="/assets/js/script_box_insert_kyniem.js"></script>
    <script>
        $(document).ready(function () {
            if (window.sessionStorage.getItem('flag_popup') != 1) {
                window.sessionStorage.setItem('flag_popup', 1);
                img_popup = $('<img>').attr('src', $("#img-popup").attr('src'));
                $('.modal-title').html('Popup');
                $('.modal-body').addClass('text-center');
                $('.modal-body').html(img_popup);
                $("#modal-id22").modal();
            }
        })
    </script>
@endsection

@section('custom_css')
@endsection
