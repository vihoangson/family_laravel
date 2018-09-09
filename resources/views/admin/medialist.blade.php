@extends('layouts/admin/layout')
@section('body')
    <div class="col-md-12">
        {{--<h4>Default</h4>--}}
        <form method="post">
            {{csrf_field()}}
            <button class="btn btn-primary">Refresh file img</button>
        </form>
        <ul class=" hidden nav nav-pills sort-source" data-sort-id="portfolio" data-option-key="filter">
            <li data-option-value="*" class="active"><a href="#">Show All</a></li>
            <li data-option-value=".websites" class=""><a href="#">Websites</a></li>
            {{--<li data-option-value=".logos" class=""><a href="#">Logos</a></li>--}}
            {{--<li data-option-value=".brands" class=""><a href="#">Brands</a></li>--}}
        </ul>

        <hr>

        <div class="row">
            {{$data->link()}}
            <ul class="image-gallery sort-destination lightbox" data-sort-id="portfolio" data-plugin-options="{&quot;delegate&quot;: &quot;a.lightbox-portfolio&quot;, &quot;type&quot;: &quot;image&quot;, &quot;gallery&quot;: {&quot;enabled&quot;: true}}" style="position: relative; height: 296.5px;">
                @foreach ($data as $val)
                    <li class="col-md-3 col-sm-6 col-xs-12 isotope-item websites" style="position: absolute; left: 0px; top: 0px;">
                        <div class="image-gallery-item">
                            <a href="{{$val->files_path}}" class="lightbox-portfolio">
                                <span class="thumb-info">
                                    <span class="thumb-info-wrapper">
                                        <img src="{{$val->files_path}}" class="img-responsive" alt="">
                                        <span class="hidden thumb-info-title">
                                            <span class="hidden thumb-info-inner">Project Title</span>
                                            <span class="hidden thumb-info-type">Project Type</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon">
                                                <i class="fa fa-link">
                                                </i>
                                            </span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{$data->link()}}
        </div>
    </div>
@endsection