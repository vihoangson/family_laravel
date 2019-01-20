@extends('layouts/template2/layout')
@section('title_page','Family detail content')
@section('body')
    @php
        //dd($data);
    @endphp

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="portfolio-title">
                    <div class="row">
                        <div class="portfolio-nav-all col-md-1 hidden">
                            <a href="portfolio-single-project.html" data-tooltip="" data-original-title="Back to list"><i class="fa fa-th"></i></a>
                        </div>
                        <div class="col-md-10 center ">
                            <h2 class="mb-none">FAMILY</h2>
                        </div>
                        <div class="portfolio-nav col-md-1">
                            <a href="/kyniem/detail/{{$data->id-1}}?op=prev" class="portfolio-nav-prev previous" data-tooltip="" data-original-title="Previous"><i class="fa fa-chevron-left"></i></a>
                            <a href="/kyniem/detail/{{$data->id+1}}?op=next" class="portfolio-nav-next next" data-tooltip="" data-original-title="Next"><i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>

                <hr class="tall">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 hidden">

                <div class="owl-carousel owl-theme owl-loaded owl-drag owl-carousel-init" data-plugin-options="{&quot;items&quot;: 1, &quot;margin&quot;: 10}">


                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(-740px, 0px, 0px); transition: all 0s ease 0s; width: 2590px;">
                            <div class="owl-item cloned" style="width: 360px; margin-right: 10px;">
                                <div>
									<span class="img-thumbnail">
										<img alt="" class="img-responsive" src="img/projects/project-1.jpg">
									</span>
                                </div>
                            </div>
                            <div class="owl-item cloned" style="width: 360px; margin-right: 10px;">
                                <div>
									<span class="img-thumbnail">
										<img alt="" class="img-responsive" src="img/projects/project-2.jpg">
									</span>
                                </div>
                            </div>
                            <div class="owl-item active" style="width: 360px; margin-right: 10px;">
                                <div>
									<span class="img-thumbnail">
										<img alt="" class="img-responsive" src="img/projects/project.jpg">
									</span>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 360px; margin-right: 10px;">
                                <div>
									<span class="img-thumbnail">
										<img alt="" class="img-responsive" src="img/projects/project-1.jpg">
									</span>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 360px; margin-right: 10px;">
                                <div>
									<span class="img-thumbnail">
										<img alt="" class="img-responsive" src="img/projects/project-2.jpg">
									</span>
                                </div>
                            </div>
                            <div class="owl-item cloned" style="width: 360px; margin-right: 10px;">
                                <div>
									<span class="img-thumbnail">
										<img alt="" class="img-responsive" src="img/projects/project.jpg">
									</span>
                                </div>
                            </div>
                            <div class="owl-item cloned" style="width: 360px; margin-right: 10px;">
                                <div>
									<span class="img-thumbnail">
										<img alt="" class="img-responsive" src="img/projects/project-1.jpg">
									</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-nav disabled">
                        <div class="owl-prev"></div>
                        <div class="owl-next"></div>
                    </div>
                    <div class="owl-dots">
                        <div class="owl-dot active"><span></span></div>
                        <div class="owl-dot"><span></span></div>
                        <div class="owl-dot"><span></span></div>
                    </div>
                </div>

            </div>

            <div class="col-md-12">

                <div class="portfolio-info">
                    <div class="row">
                        <div class="col-md-12 center">
                            <ul>
                                <li>
                                    <a href="#" data-tooltip="" data-original-title="Like"><i class="fa fa-heart"></i></a>
                                </li>
                                <li>
                                    <i class="fa fa-calendar"></i> {{$data->kyniem_create->format('d/m/Y H:i:s')}}
                                </li>
                                <li>
                                    <i class="fa fa-tags"></i> <a href="#">Brand</a>, <a href="#">Design</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <h1></h1>

                <h4 class="heading-primary"><strong>{{$data->kyniem_title}}</strong></h4>

                {!! $data->kyniem_content_markdown !!}

                <a href="" class="btn btn-primary btn-icon"><i class="fa fa-external-link"></i>Live Preview</a>
                <span class="arrow hlb appear-animation rotateInUpLeft appear-animation-visible" data-appear-animation="rotateInUpLeft" data-appear-animation-delay="800" style="animation-delay: 800ms;"></span>

                <ul class="portfolio-details hidden">
                    <li>
                        <p><strong>Skills:</strong></p>

                        <ul class="list list-inline list-icons">
                            <li><i class="fa fa-check-circle"></i> Design</li>
                            <li><i class="fa fa-check-circle"></i> HTML/CSS</li>
                            <li><i class="fa fa-check-circle"></i> Javascript</li>
                            <li><i class="fa fa-check-circle"></i> Backend</li>
                        </ul>
                    </li>
                    <li>
                        <p><strong>Client:</strong></p>
                        <p>Okler Themes</p>
                    </li>
                </ul>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <hr class="tall">

                <h4 class="mb-md text-uppercase">Related <strong>Post</strong></h4>

                <div class="row">

                    <ul class="portfolio-list">
                        @foreach($other as $v)
                            <li class="col-md-3 col-sm-6 col-xs-12">
                                <div class="portfolio-item">
                                    <a href="{{route('kyniem_detail_id',$v->id)}}">
												<span class="thumb-info">
													<span class="thumb-info-wrapper">
                                                        {{--{{$v->kyniem_img_thumb}}--}}
														<div><img src="{{$v->kyniem_img_thumb}}" class="img-responsive" alt=""></div>
														<span class="thumb-info-title hidden">
															<span class="thumb-info-inner">Random Chars</span>
															<span class="thumb-info-type">Website</span>
														</span>
														<span class="thumb-info-action">
															<span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
														</span>

													</span>
												</span>
                                        @if($v->kyniem_title)
                                            {{$v->kyniem_title}}
                                        @else
                                            {{$v->kyniem_create->format('d-m-Y H:i:s')}}
                                        @endif

                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>

    </div>



@endsection

@section('custom_js')
    <script>
        // Xử lý bấm ctrl+enter sẽ submit bài viết
        $(document).on("keydown", function (e) {

            if ((e.keyCode == 37)) {
                console.log($('.previous').attr('href'));

                $(location).attr('href', $('.previous').attr('href'));
            }
            if ((e.keyCode == 39)) {
                console.log($('.next').attr('href'));
                $(location).attr('href', $('.next').attr('href'));
            }
        });

        function equalHeight() {
            var $colClass = $('.portfolio-item .thumb-info-wrapper div'), //class name of columns
                heights = $colClass.map(function () { //get height of all columns, pass it to an array (heights)
                    return $(this).height();
                }).get();

            $colClass.height(Math.max.apply(null, heights));
        }

        equalHeight();
    </script>
@endsection

@section('custom_css')
    <style>
        .thumb-info-wrapper div {
            vertical-align: middle;
            display: table-cell;
        }
        .thumb-info-wrapper div img {
            max-height: 250px;
            width: 100%;
        }
    </style>

@endsection
