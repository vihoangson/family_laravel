var loadKyniem = function () {
    var step = $(".message-item").last().data("step") + 1;
    if ($(".fa-spin").length == 0) {
        $("#wallmessages").append('<div class="text-center"><i style="color:#828282;" class="fa fa-refresh fa-spin fa-3x"></i></div>');
        $.get('/api/getkyniem?step=' + step, function (data) {
            $(".fa-spin").remove();
            if (data.length > 0) {
                $.each(data, function (k, v) {
                    //<editor-fold desc="Đổ dữ liệu vào blog">
                    var mmm = $(".message-item").first().clone();
                    mmm.attr('data-step', parseInt(step) + parseInt(k));

                    if (v.kyniem_title != '') {
                        mmm.find('.block-title').html(v.kyniem_title);
                    } else {
                        mmm.find('.block-title').html('Happy Family');
                    }

                    if((v.user.hasOwnProperty('avatar'))){
                        mmm.find('.img-avatar').attr('src', v.user.avatar);
                    }

                    mmm.find('.toolb .b-edit').attr('href', '/kyniem/edit?id=' + v.id);
                    mmm.find('.toolb .b-delete').attr('href', '/kyniem/delete?id=' + v.id);

                    mmm.find('.block-datetime').html(v.kyniem_create);
                    mmm.find('.block-content').html(v.kyniem_content_markdown);
                    mmm.find('.block-button-detail a').attr('href','/kyniem/detail/'+v.id);
                    mmm.find('input').attr('kyniemid', v.id);
                    mmm.find('.comment-group').attr('cgid', v.id);

                    //</editor-fold>

                    //<editor-fold desc="Comment blog">
                    mmm.find('.comment-block').addClass('hidden');
                    mmm.find('.comment-content').html('');
                    mmm.find('.comment-by strong').html('');

                    if (v.comment.length > 0) {
                        div_comment_content = reloadComment(v.comment);
                        mmm.find(".comment-group").append(div_comment_content);
                    }
                    //</editor-fold>

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
$(document).ready(function () {
    $('.b-edit').click(function (e) {
    });
});

function reloadComment(comment) {
    if (comment.length == 0) return;
    var div_border = $("<div>");
    $.each(comment, function (k1, v1) {
        var nn = $('.comment-block').first().clone();
        nn.show();
        nn.find('.comment-content').html(v1.comment_content);
        nn.find('.comment-by strong.name-auth').html(v1.usercomment.name);
        nn.removeClass('hidden')
        div_border.append(nn)
    })
    return div_border
}

// Scroll to ending of page
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
        loadKyniem();
    }
});

$(document).on("click", ".submit-comment", function (e) {
    var comment_content = $(this).parents('.comment-border').find("input").val();
    var comment_kyniem_id = $(this).parents('.comment-border').find("input").attr('kyniemid');
    var token_hash = $(this).parents('.comment-border').find("input").data('token');

    this_s = $(this);
    $.post('/api/kyniem/insert_comment', {
        'token_hash': token_hash,
        'comment_kyniem_id': comment_kyniem_id,
        'comment_content': comment_content
    }, function (data) {
        this_s.parents('.comment-border').find("input").val("");
        this_s.parents('.comment-border').find(".comment-group").html('');
        // v.comment
        div_comment_content = reloadComment(data);
        this_s.parents('.comment-border').find(".comment-group").append(div_comment_content);
    })
})

// Click on button Load more
$(".loadmore").click(function (event) {
    loadKyniem();
});