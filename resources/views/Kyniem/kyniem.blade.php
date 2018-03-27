@extends('layouts/template2/layout')
@section('title_page','Trang chủ')
@section('title_body','Trang chủ')

@section('body')

    <form action='/kyniem/store' method="post">
        {{ csrf_field() }}
        <textarea class="form-control" id="content" name="content"></textarea>
        <label for="fileupload" class="btn btn-default">Choose a file</label>
        <input class="hidden" id="fileupload" type="file" name="userfile" multiple="" data-url="/ajax_up_files" accept="image/x-png,image/gif,image/jpeg" >
        <button class="btn btn-primary">Submit</button>
    </form>



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
    <script src="http://family.vn/asset/js/Magnific-Popup-master/dist/jquery.magnific-popup.js"></script>
    <script src="/assets/bower_components/jquery-form/jquery.form.js"></script>
    <script src="/assets/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
    <script src="/assets/bower_components/Snarl/dist/snarl.min.js"></script>
    <script src="/assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/bower_components/blueimp-file-upload/js/jquery.fileupload.js"></script>
    <script src="/assets/bower_components/bootstrap-datepicker\dist\js\bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function(){
        // Upload ảnh ở trang chủ
        if($('#fileupload').length){
            $('#fileupload').fileupload({
                dataType: 'json',
                add: function (e, data) {
                    data.context = $('<p/>').text('Uploading...').appendTo(document.body);
                    data.submit();
                },
                done: function (e, data) {
                    console.log(data.result);
                    data.context.text('Upload finished.');
                    $("#content").val($("#content").val() + data.result.markdown);
                }
            });
        }
    })

</script>
@endsection

@section('custom_css')
@endsection
