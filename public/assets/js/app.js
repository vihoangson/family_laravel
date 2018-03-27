$(".add-kyniem").click(function(){
    $.get('/api/box_add',function(e){
        $('#modal-id').find('.modal-body').html(e);
        $('#modal-id').modal();
    })
})

