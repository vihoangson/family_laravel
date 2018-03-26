$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
        loadKyniem();
    }
});

$(".loadmore").click(function (event) {
    loadKyniem();
});

var loadKyniem = function () {
    var step = $(".message-item").last().data("step") + 1;
    if ($(".fa-spin").length == 0) {
        $("#wallmessages").append('<div class="text-center"><i style="color:#828282;" class="fa fa-refresh fa-spin fa-3x"></i></div>');
        $.get('/api/getkyniem?step=' + step, function (data) {
            $(".fa-spin").remove();
            if (data) {
                $("#wallmessages").append(data);
            } else {
                alert("Hết rồi!");
            }
        });
    }
}
