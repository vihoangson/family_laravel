@extends('layouts/admin/layout')
@section('title_content')
Setting user
@endsection
@section('body')
    <form method="post" action="{{route('setting.store')}}">
        {{csrf_field()}}

        @foreach($array_settings as $k => $v)
            <div class="form-group">
                <label><strong>{{$k}}</strong></label>
                @if($v['type'] == 'image')
                    <div><img class="thumbnail" src="{{$v['value']}}" style="width: 100px;"></div>
                @endif
                <input type="text" class="form-control" name="{{$k}}" value="{{$v['value']}}">
            </div>
            <hr>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
@section('custom_js')

@endsection

