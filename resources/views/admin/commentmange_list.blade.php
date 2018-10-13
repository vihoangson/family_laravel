@extends('layouts/admin/layout')
@section('body')
    {{$data->links()}}
    @foreach($data as $value)
        <div class="comment-manage-ele">
            <div class="block-comment-content-kyniem">
                {!! $value->getRelation('Kyniem')['kyniem_content_markdown'] !!}
            </div>
            <div class="block-comment">{!! $value['comment_content'] !!}</div>
        </div>
        <hr>
    @endforeach
    {{$data->links()}}
@endsection
@section('custom_css')
    <style>
        .block-comment{
            background: #ccc;
        }

        .block-comment-content-kyniem {
            background: #ececec;
            padding: 5px;
            border-radius: 9px;
        }
        .block-comment {
            background: #f9f9f9;
            padding: 9px;
            margin: 10px 0;
        }
        .comment-manage-ele {
            border: 1px solid #f5f5f5;
            border-radius: 10px;
            padding: 10px;
            background: #f5f5f5;
        }
    </style>
@endsection