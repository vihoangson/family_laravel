@extends('layouts/template2/layout')
@section('title_page','Trang chủ')
@section('title_body','Trang chủ')

@section('body')

    <div id="input-content">
        <form action='/kyniem/store' method="post" id="form-insert-kyniem">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$data->id}}"/>
            <input class="datepicker" name="date_create" value="{{$data->date_format->format('d/m/Y')}}"/>
            <input class="form-control" id="title" name="title" placeholder="Tiêu đề" style="margin-bottom: 5px;" value="{{$data->kyniem_title}}">

            <textarea class="form-control" id="content" name="content" placeholder="Nội dung">{{$data->kyniem_content}}</textarea>

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
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
            });
        });

    </script>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endsection
