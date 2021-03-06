<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title_page')</title>

    <meta name="keywords" content="HTML5 Template"/>
    <meta name="description" content="">
    <meta name="author" content="vihoangson.com">
    <base href="/tempates/porto/">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/theme_custom.css">

    <link rel="stylesheet" href="css/theme-elements.css">
    <link rel="stylesheet" href="css/theme-blog.css">
    <link rel="stylesheet" href="css/theme-shop.css">
    <link rel="stylesheet" href="css/theme-animate.css">


    <!-- Skin CSS -->
    <link rel="stylesheet" href="css/skins/default.css">
    <script src="master/style-switcher/style.switcher.localstorage.js"></script>

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    @include('layouts/includes/css')

    <!-- Head Libs -->
    <script src="vendor/modernizr/modernizr.min.js"></script>


    @yield('custom_css')
</head>
<body>

<div class="body">
    <header id="header" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": true}'>
        <div class="header-body">
            <div class="header-container container">
                <div class="header-row">
                    <div class="header-column">
                        <div class="header-logo">
                            <a href="/">
                                <img alt="Porto" width="111" height="54" data-sticky-width="82" data-sticky-height="40" data-sticky-top="33" src="img/logo.png">
                            </a>
                        </div>
                    </div>
                    <div class="header-column">
                        <div class="header-row">
                            <div class="header-search hidden-xs">
                                @include('layouts/includes/form_search_header')
                            </div>
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills">
                                    <li class="hidden-xs hidden">
                                        <a href="#"><i class="fa fa-angle-right"></i> About Us</a>
                                    </li>
                                    <li class="hidden-xs hidden">
                                        <a href="#"><i class="fa fa-angle-right"></i> Contact Us</a>
                                    </li>
                                    <li>
                                        <span class="ws-nowrap"><i class="fa fa-phone"></i> Gia đình là số một</span>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-row">
                            <div class="header-nav">
                                <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <ul class="header-social-icons social-icons hidden-xs">
                                    <li class="social-icons-facebook">
                                        <a href="http://www.facebook.com/vihoangson" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="social-icons-twitter">
                                        <a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="social-icons-linkedin">
                                        <a href="#" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>
                                <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">

                                    @include('layouts/template2/navbar')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div role="main" class="main">

        <section class="page-header">

            <div class="container">
                <div class="row hidden">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active">Pages</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h1>@yield('title_body')</h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">

            <div class="row">
                <div class="col-md-3">
                    <aside class="sidebar">

                        <h4 class="heading-primary">Danh mục</h4>
                        <ul class="nav nav-list mb-xlg">
                            <li><a href="{{route('admin_options')}}">Options</a></li>
                            <li><a href="{{route('media.index')}}">Media</a></li>
                            <li><a href="{{route('cloud.index')}}">Cloud</a></li>
                            <li><a href="{{route('family-tree-index')}}">Family tree</a></li>
                            <li><a href="{{route('do_restore')}}" onclick="return confirm('Chắc là muốn backup không')">Do restore</a></li>
                            <li><a href="{{route('do_backup')}}" onclick="return confirm('Chắc là muốn backup không')">Do backup</a></li>
                            <li><a href="{{route('list_file_db_backup')}}">List file db backup</a></li>
                            <li><a href="{{route('comment_manage.index')}}">Quản lý comment</a></li>
                            <li><a href="{{route('report_system')}}">Report system</a></li>

                            <li class="hidden">
                                <a href="{{route('admin_options')}}">Photos (4)</a>
                                <ul>
                                    <li><a href="{{route('admin_options')}}">Animals</a></li>
                                    <li><a href="{{route('admin_options')}}">Business</a></li>
                                    <li><a href="{{route('admin_options')}}">Sports</a></li>
                                    <li><a href="{{route('admin_options')}}">People</a></li>
                                </ul>
                            </li>
                        </ul>

                        <div class="tabs mb-xlg">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#popularPosts" data-toggle="tab"><i class="fa fa-star"></i> Popular</a>
                                </li>
                                <li><a href="#recentPosts" data-toggle="tab">Recent</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="popularPosts">
                                    <ul class="simple-post-list">
                                        <li>
                                            <div class="post-image">
                                                <div class="img-thumbnail">
                                                    <a href="blog-post.html">
                                                        <img src="img/blog/blog-thumb-1.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>
                                                <div class="post-meta">
                                                    Jan 10, 2015
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-image">
                                                <div class="img-thumbnail">
                                                    <a href="blog-post.html">
                                                        <img src="img/blog/blog-thumb-2.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a href="blog-post.html">Vitae Nibh Un Odiosters</a>
                                                <div class="post-meta">
                                                    Jan 10, 2015
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-image">
                                                <div class="img-thumbnail">
                                                    <a href="blog-post.html">
                                                        <img src="img/blog/blog-thumb-3.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a href="blog-post.html">Odiosters Nullam Vitae</a>
                                                <div class="post-meta">
                                                    Jan 10, 2015
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane" id="recentPosts">
                                    <ul class="simple-post-list">
                                        <li>
                                            <div class="post-image">
                                                <div class="img-thumbnail">
                                                    <a href="blog-post.html">
                                                        <img src="img/blog/blog-thumb-2.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a href="blog-post.html">Vitae Nibh Un Odiosters</a>
                                                <div class="post-meta">
                                                    Jan 10, 2015
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-image">
                                                <div class="img-thumbnail">
                                                    <a href="blog-post.html">
                                                        <img src="img/blog/blog-thumb-3.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a href="blog-post.html">Odiosters Nullam Vitae</a>
                                                <div class="post-meta">
                                                    Jan 10, 2015
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-image">
                                                <div class="img-thumbnail">
                                                    <a href="blog-post.html">
                                                        <img src="img/blog/blog-thumb-1.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>
                                                <div class="post-meta">
                                                    Jan 10, 2015
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4 class="heading-primary">About Us</h4>
                        <p>Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Nulla nunc dui, tristique in semper vel. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. </p>

                    </aside>
                </div>
                <div class="col-md-9">

                    @include('layouts/includes/error_validate')

                    <h2>@yield('title_content','Admin')</h2>
                    <div class="row">
                        @yield('body')
                    </div>
                </div>

            </div>

        </div>

    </div>

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="footer-ribbon">
                    <span>Get in Touch</span>
                </div>
                <div class="col-md-3">
                    <div class="newsletter">
                        <h4>Gia đình là số một</h4>
                        <p class="hidden">Keep up on our always evolving product features and technology. Enter your e-mail and subscribe to our newsletter.</p>

                        <div class="alert alert-success hidden" id="newsletterSuccess">
                            <strong>Success!</strong> You've been added to our email list.
                        </div>

                        <div class="alert alert-danger hidden" id="newsletterError"></div>

                        <form class="hidden" id="newsletterForm" action="php/newsletter-subscribe.php" method="POST">
                            <div class="input-group">
                                <input class="form-control" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
                                <span class="input-group-btn">
											<button class="btn btn-default" type="submit">Go!</button>
										</span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4 class="hidden">Latest Tweets</h4>
                    <div id="tweet" class="twitter hidden" data-plugin-tweets data-plugin-options='{"username": "oklerthemes", "count": 2}'>
                        <p>Please wait...</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-details">
                        <h4>Địa chỉ nhà mình - Gia đình là số một</h4>
                        <ul class="contact">
                            <li><p><i class="fa fa-map-marker"></i>
                                    <strong>Địa chỉ:</strong> </p></li>
                            <li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> </p></li>
                            <li><p><i class="fa fa-envelope"></i> <strong>Email:</strong>
                                    <a href="mailto:vihoangson@gmail.com">vihoangson@gmail.com</a></p></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <h4>Follow Us</h4>
                    <ul class="social-icons">
                        <li class="social-icons-facebook">
                            <a href="http://www.facebook.com/vihoangson" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="social-icons-twitter">
                            <a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li class="social-icons-linkedin">
                            <a href="#" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-1"   >
                        <a href="#" class="logo">
                            <img alt="Porto Website Template" class="img-responsive" src="img/logo-footer.png">
                        </a>
                    </div>
                    <div class="col-md-7">
                        <p>© Copyright 2015. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-4">
                        <nav id="sub-menu">
                            <ul>
                                <li><a href="#">FAQ's</a></li>
                                <li><a href="#">Sitemap</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>


<div class="modal fade" id="modal-id22">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Vendor -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="vendor/jquery-cookie/jquery-cookie.min.js"></script>
<script src="master/style-switcher/style.switcher.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/common/common.min.js"></script>
<script src="vendor/jquery.validation/jquery.validation.min.js"></script>
<script src="vendor/jquery.stellar/jquery.stellar.min.js"></script>
<script src="vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
<script src="vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script src="vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<script src="vendor/isotope/jquery.isotope.min.js"></script>
<script src="vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="vendor/vide/vide.min.js"></script>


<!-- Theme Base, Components and Settings -->
<script src="js/theme.js"></script>

<!-- Theme Custom -->
<script src="js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="js/theme.init.js"></script>

<script src="master/analytics/analytics.js"></script>
@include('layouts/includes/javascript')


@yield('custom_js')

</body>
</html>
