@if(session('msgToast'))
    <div id="msg-toast" title="{{session('msgToast')}}"></div>
@endif

<script src="/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

<script>
    if($('#msg-toast').length>0){
        $.toast($('#msg-toast').attr('title'));
    }
</script>