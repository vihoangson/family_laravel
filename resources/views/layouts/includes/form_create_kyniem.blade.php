<form action='{{isset($data->id)?'/kyniem/store':'/kyniem/store'}}' method="post" id="form-insert-kyniem">
    {{ csrf_field() }}
    @if(isset($data->id))
        <input type="hidden" name="id" value="{{isset($data->id)?$data->id:''}}"/>
    @endif
    @if(isset($data->date_format))
        <input class="datepicker" name="date_create" value="{{isset($data->date_format)?$data->date_format->format('d/m/Y'):''}}"/>
    @endif

    <input class="form-control" id="title" name="title" placeholder="Tiêu đề" style="margin-bottom: 5px;" value="{{isset($data->kyniem_title)?$data->kyniem_title:''}}">

    <textarea class="form-control" id="content" name="content" placeholder="Nội dung">{{isset($data->kyniem_content)?$data->kyniem_content:''}}</textarea>

    <div class="block-background">
        <div class="changebg background blue" data-style="blue"></div>
        <div class="changebg background red" data-style="red"></div>
        <div class="changebg background pink" data-style="pink"></div>
        <div class="changebg background rose" data-style="rose"></div>
        <div class="changebg background rose2" data-style="rose2"></div>
        <div class="changebg background candy" data-style="candy"></div>
    </div>
    <div class="clearfix"></div>


    <div class="text-left " style="margin-top:10px;" id="box-typing-auto">
        <a href="" class="typewrite" data-period="5000" data-type='[ "Xin chào, Bố Sơn đây", "Kem phải ăn ngoan ngủ ngoan nhé","Thương con và mẹ nhiều lắm","Một ngày bắt đầu bố thấy rất vui và hạnh phúc","Khi nhìn thấy con cười","Mỗi ngày bố chở Kem đi học đều chụp hình cho con để thấy được con lớn từng ngày như thế nào" ]'>
            <span class="wrap"></span>
        </a>
    </div>

    <div class="text-right " style="margin-top:10px;" id="box-button-submit">
        <label for="fileupload" class="btn btn-default">Choose a file</label>
        <input class="hidden" id="fileupload" type="file" name="userfile" multiple="" data-url="/ajax_up_files" accept="image/x-png,image/gif,image/jpeg">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>