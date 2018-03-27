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

// Xử lý bấm ctrl+enter sẽ submit bài viết
$(document).on("keydown", "#content,#title", function (e) {
    if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey) {
        $("#content").closest('form').submit();
    }
});