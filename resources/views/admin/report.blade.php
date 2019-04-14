@extends('layouts/admin/layout')
@section('body')
    <pre>{{$array_options}}</pre>

    <h2>Testing system</h2>
    <div id='rs-testing'>
        <div id='upload_max_filesize'><b>upload_max_filesize</b>: <span><i class="fa fa-refresh fa-spin"></i></span>
        </div>
        <div id='post_max_size'><b>post_max_size</b>: <span><i class="fa fa-refresh fa-spin"></i></span></div>
        <div id='upload_to_cloud'><b>upload_to_cloud</b>: <span><i class="fa fa-refresh fa-spin"></i></span></div>
        <div id='check_send_mail'><b>check_send_mail</b>: <span><i class="fa fa-refresh fa-spin"></i></span></div>
        <div id='send_chatwork'><b>send_chatwork</b>: <span><i class="fa fa-refresh fa-spin"></i></span></div>
    </div>
@endsection
@section('custom_js')
    <script>
        $.get('/api/testing', function (rs) {
            $.each(rs, function (k, v) {
                selet = $("#" + k + "");
                selet.children('span').text(v.result);
                if (v.result === true) {
                    selet.children('span').text('True');
                    selet.children('span').addClass('label');
                    selet.children('span').addClass('label-success');
                } else {
                    selet.children('span').text('Fail');
                    selet.children('span').addClass('label');
                    selet.children('span').addClass('label-danger');
                    selet.append($("<div></div>").text('errors: ' + v.errors));
                }
                selet.append($("<div></div>").text('expected: ' + v.expected));
                selet.append($("<div></div>").text('real_value: ' + eval('v.real_value')));
                selet.append($("<hr>"));

            });
        });
    </script>
@endsection

