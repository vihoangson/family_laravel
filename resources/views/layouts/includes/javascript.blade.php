@if(session('msgToast'))
    <div id="msg-toast" title="{{session('msgToast')}}"></div>
@endif

<script src="/assets/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

<script>
    if($('#msg-toast').length>0){

        $.toast({
            heading: 'Message',
            text: $('#msg-toast').attr('title'),
            position: 'top-right',
            stack: false
        });
    }
</script>