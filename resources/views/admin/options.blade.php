@extends('layouts/admin/layout')
@section('title_content')
Options admin
@endsection
@section('body')
    <form method="post" action="{{route('admin_options_save')}}">
        {{csrf_field()}}

        @foreach($array_options as $k => $v)
            <div class="form-group">
                <label>{{$k}}</label>
                <input type="text" class="form-control" name="{{$k}}" value="{{$v['value']}}">
            </div>
        @endforeach
        <a href="{{route('clear_cache_options')}}" class="btn btn-default">Clear cache</a>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

@endsection
@section('custom_js')

@endsection

