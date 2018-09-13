$(document).ready(function () {
    // Upload ảnh ở trang chủ
    if ($('#fileupload').length) {

        $('#fileupload').fileupload({
            dataType: 'json',
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                //console.log(progress);
                $('#progress-b').attr('aria-valuenow', progress);
                $('#progress-b').width(progress + "%");

                // $('#progress .bar').css(
                //     'width',
                //     progress + '%'
                // );
            },
            add: function (e, data) {
                $('#process-bm').show()
                data.context = $('<p/>').text('Uploading...').appendTo(document.body);
                data.submit();
            },
            done: function (e, data) {
                $('#process-bm').hide()
                console.log(data.result);
                data.context.text('Upload finished.');
                $("#content").val($("#content").val() + data.result.markdown);
            }
        });
    }
})

// Xử lý bấm ctrl+enter sẽ submit bài viết
$(document).on("keydown", "#content,#title", function (e) {
    if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey) {
        $("#content").closest('form').submit();
    }
});