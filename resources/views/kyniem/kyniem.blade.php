@extends('layouts/template2/layout')
@section('title_page','Trang chủ')
@section('title_body','Trang chủ')

@section('body')
    <div id="input-content">
        <form action='/kyniem/store' method="post" id="form-insert-kyniem">
            {{ csrf_field() }}

            <input class="form-control" id="title" name="title" placeholder="Tiêu đề" style="margin-bottom: 5px;">

            <textarea class="form-control" id="content" name="content" placeholder="Nội dung"></textarea>

            <div class="text-left " style="margin-top:10px;" id="box-typing-auto">
                <a href="" class="typewrite" data-period="5000" data-type='[ "Xin chào, Bố Sơn đây", "Kem phải ăn ngoan ngủ ngoan nhé","Thương con và mẹ nhiều lắm","Một ngày bắt đầu bố thấy rất vui và hạnh phúc","Khi nhìn thấy con cười","Mỗi ngày bố chở Kem đi học đều chụp hình cho con để thấy được con lớn từng ngày như thế nào" ]'>
                    <span class="wrap"></span>
                </a>
            </div>

            <div class="text-right " style="margin-top:10px;" id="box-button-submit">
                <label for="fileupload" class="btn btn-default">Choose a file</label>
                <input class="hidden" id="fileupload" type="file" name="userfile" multiple="" data-url="/ajax_up_files" accept="image/x-png,image/gif,image/jpeg">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div id='wallmessages'>
        <div class="message-item hidden well" data-step="-1">
            <div class="b-toolb">
                <ul class="toolb">
                    <li><a class="b-edit" href="">Edit</a></li>
                    <li><a class="b-delete" href="">Delete</a></li>
                </ul>
            </div>
            <h2 class="block-title"></h2>
            <i class="block-datetime"></i>
            <div class="block-content"></div>
            <hr>
        </div>
    </div>
    <button class="loadmore btn btn-primary">Load more</button>


    <img src="{{$options_popup}}" class="hidden" id="img-popup">
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
    $(document).ready(function(){
        if(window.sessionStorage.getItem('flag_popup') != 1){
            window.sessionStorage.setItem('flag_popup',1);
            img_popup = $('<img>').attr('src',$("#img-popup").attr('src'));
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
