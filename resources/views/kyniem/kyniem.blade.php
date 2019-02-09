@extends('layouts/template2/layout')
@section('title_page','Trang chủ')
@section('title_body','Trang chủ')

@section('body')
    <div id="input-content">
        @include('layouts.includes.form_create_kyniem')
    </div>
    <div class="progress" id="process-bm" style="display:none;">
        <div class="progress-bar progress-bar-striped active" id="progress-b" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            <span class="sr-only">60% Complete</span>
        </div>
    </div>
    <div id='wallmessages'>
        <div class="message-item hidden well" data-step="-1">
            <div class="b-toolb">
                <ul class="toolb">
                    <li><a class="b-edit" href="">Edit</a></li>
                    <li><a class="b-delete" onclick="return confirm('Are you sure?')" href="">Delete</a></li>
                </ul>
            </div>
            <img class="thumbnail text-center img-avatar" src="http://placehold.it/200x200">
            <h2 class="block-title"></h2>
            <i class="block-datetime"></i>
            <div class="clearfix"></div>
            <div class="block-content"></div>
            <div class="block-button-detail"><a href='#' class="btn btn-default btn-sm">Chi tiết »</a></div>
            <hr>
            <div class="comment-border">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Comment ..." data-token="{{csrf_token()}}" kyniemid="">
                    <span class="input-group-btn">
                    <button class="btn btn-default submit-comment" type="button">Go!</button>
                    </span>
                </div><!-- /input-group -->
                <div class="comment-group" cgid=""></div>
            </div>
        </div>
    </div>

    <button class="loadmore btn btn-primary">Load more</button>

    <div class="comment-block hidden">
        <div class="comment-arrow"></div>
        <span class="comment-by"><strong class="name-auth"></strong></span>
        <div class="comment-content"></div>
    </div>

    <img src="{{cache('options_popup')}}" class="hidden" id="img-popup">
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

            // <!--<editor-fold desc="Get tag and push to text area">-->
            $.get('/api/tag',function($e){
                $.each($e,function($k,$v){
                    console.log($v);
                    $("#content").after(' <a href="#" class="push-tag" data-tag="'+$v.name+'">[#'+$v.name+']</a> ')
                });

                $('.push-tag').click(function($e){
                    $("#content").val($("#content").val() + '\n [#'+$(this).attr('data-tag')+'] \n');
                    $e.preventDefault();
                });

            });
            //<!--</editor-fold>-->

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
    <style>
        .comment-block {
            background: white;
            padding: 10px;
            margin: 10px 0;
            border-radius: 10px;
        }
        img.img-avatar {
            width: 100px;
            /* position: absolute; */
            float: left;
            /* left: -108px; */
            margin-right: 13px;
        }
    </style>

@endsection
