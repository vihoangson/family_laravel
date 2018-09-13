@php
    if(!isset($carousel) || $carousel==[] ){
        $carousel=[
            ['url'=>'http://placehold.it/1800x300','title'=>'title 1','active'=>true],
            ['url'=>'http://placehold.it/1800x300','title'=>'title 2','active'=>false],
            ['url'=>'http://placehold.it/1800x300','title'=>'title 3','active'=>false],
            ['url'=>'http://placehold.it/1800x300','title'=>'title 4','active'=>false],
            ['url'=>'http://placehold.it/1800x300','title'=>'title 5','active'=>false]
        ];
    }
@endphp

<div id="carousel-example-generic" class="carousel slide  visible-md visible-lg" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators visible-md visible-lg">
        @foreach ($carousel as $key => $user)
            <li data-target="#carousel-example-generic" data-slide-to="{{$key}}" {{$key==0?'class="active"':''}}></li>
        @endforeach

    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @foreach ($carousel as $key=>$user)
            <div class="item {{$key==0?'active':''}}">
                <img src="{{$user['url']}}" alt="{{$user['title']}}">
                <div class="carousel-caption  visible-md visible-lg">
                    {{$user['title']}}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>