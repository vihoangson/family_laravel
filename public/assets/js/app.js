$(".add-kyniem").click(function(){
    $.get('/api/box_add',function(e){
        $('#modal-id').find('.modal-body').html(e);
        $('#modal-id').modal();
    })
})

$(".changebg").click(function(){
    $("#content").val($("#content").val() + '[background='+$(this).data('style')+'][/background]')
})