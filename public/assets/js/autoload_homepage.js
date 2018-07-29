var loadKyniem = function () {
    var step = $(".message-item").last().data("step")+1;
    if ($(".fa-spin").length == 0) {
        $("#wallmessages").append('<div class="text-center"><i style="color:#828282;" class="fa fa-refresh fa-spin fa-3x"></i></div>');
        $.get('/api/getkyniem?step=' + step, function (data) {
            $(".fa-spin").remove();
            if (data.length > 0) {
                $.each(data, function (k, v) {
                    var mmm = $(".message-item").last().clone();
                    mmm.attr('data-step', parseInt(step) + parseInt(k));

                    if(v.kyniem_title != ''){
                        mmm.find('.block-title').html(v.kyniem_title);
                    }else{
                        mmm.find('.block-title').html('Happy Family');
                    }

                    mmm.find('.toolb .b-edit').attr('href', '/kyniem/edit?id=' + v.id);
                    mmm.find('.toolb .b-delete').attr('href', '/kyniem/delete?id=' + v.id);

                    mmm.find('.block-datetime').html(v.kyniem_create);
                    mmm.find('.block-content').html(v.kyniem_content_markdown);
                    mmm.removeClass('hidden');
                    mmm.appendTo('#wallmessages');
                })
            } else {
                alert("Hết rồi!");
            }
        });
    }
}

// Load init
loadKyniem();
$(document).ready(function(){
    $('.b-edit').click(function(e){
        console.log(1234123);
        e.preventDefault();
    });
});

// Scroll to ending of page
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
        loadKyniem();
    }
});

// Click on button Load more
$(".loadmore").click(function (event) {
    loadKyniem();
});