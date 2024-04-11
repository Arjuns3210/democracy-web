<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="{{ $tags['keywords'] }}">
    <link rel="canonical" href="{{ $tags['canonical'] }}" />
    <meta name="description" content="{{ $tags['description'] }}">
    <title>{{ $tags['title'] }}</title>

    <!-- icofont-css-link -->
    <link rel="stylesheet" href="{{ asset('frontend/css/icofont.min.css') }}">
    <!-- Owl-Carosal-Style-link -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <!-- Bootstrap-Style-link -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- Aos-Style-link -->
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
    <!-- Coustome-Style-link -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <!-- Responsive-Style-link -->
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/nav/logof.png') }}" type="image/x-icon">

</head>
<body>
    <!-- Page-wrapper-Start -->
    <div class="page_wrapper">
        <div id="liveToast" class="toast" role="alert" style="z-index: 9999999999999;">
            <div class="d-flex justify-content-between w-100">
                <div class="toast-body text-white">
                    Thank You! We Got Your Query, We Will Contact You Shortly..
                </div>
            </div>
        </div>
        <!-- Preloader -->
        <div id="preloader">
            <div id="loader"></div>
        </div>
        {{-- Nav Start --}}
        <!-- Header Start -->
        <header class="white_header">
            <!-- container start -->
            <div class="container">
                <!-- navigation bar -->
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('frontend/images/nav/logo_side.png') }}" alt="image">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <!-- <i class="icofont-navigation-menu ico_menu"></i> -->
                            <div class="toggle-wrap">
                                <span class="toggle-bar"></span>
                            </div>
                        </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <!-- secondery menu start -->
                            <li class="nav-item">
                                <a class="nav-link" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="privacy">Privacy Policy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="terms">Terms & Conditions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link dark_btn" href="contact">CONTACT US</a>
                            </li>
                        </ul>
                        <!-- secondery menu end -->
                    </div>
                </nav>
                <!-- navigation end -->
            </div>
            <!-- container end -->
        </header>
        {{-- Nav end --}}
        @yield('content')
        {{-- Footer Start --}}
        <!-- Footer-Section start -->
        <footer>
            <div class="top_footer" id="contact">
                <!-- animation line -->
                <div class="anim_line dark_bg">
                    <span><img src="{{ asset('frontend/images/anim_line.png') }}" alt="anim_line"></span>
                    <span><img src="{{ asset('frontend/images/anim_line.png') }}" alt="anim_line"></span>
                    <span><img src="{{ asset('frontend/images/anim_line.png') }}" alt="anim_line"></span>
                    <span><img src="{{ asset('frontend/images/anim_line.png') }}" alt="anim_line"></span>
                    <span><img src="{{ asset('frontend/images/anim_line.png') }}" alt="anim_line"></span>
                    <span><img src="{{ asset('frontend/images/anim_line.png') }}" alt="anim_line"></span>
                    <span><img src="{{ asset('frontend/images/anim_line.png') }}" alt="anim_line"></span>
                    <span><img src="{{ asset('frontend/images/anim_line.png') }}" alt="anim_line"></span>
                    <span><img src="{{ asset('frontend/images/anim_line.png') }}" alt="anim_line"></span>
                </div>
                <!-- container start -->
                <div class="container">
                    <!-- row start -->
                    <div class="row">
                        <!-- footer link 1 -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="abt_side">
                                <div class="logo"> <img src="{{ asset('frontend/images/nav/logo_side.png') }}"
                                        alt="image"></div>

                                <ul class="social_media">
                                    <li><a href="#"><i class="icofont-facebook"></i></a></li>
                                    <li><a href="#"><i class="icofont-twitter"></i></a></li>
                                    <li><a href="#"><i class="icofont-instagram"></i></a></li>
                                    <li><a href="#"><i class="icofont-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- footer link 2 -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="links">
                                <h3>Useful Links</h3>
                                <ul>
                                    <li><a href="/">Home</a></li>
                                    {{-- <li><a href="#">About us</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Blog</a></li> --}}
                                    <li><a href="terms">Terms & conditions</a></li>
                                    <li><a href="privacy">Privacy policy</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- footer link 3 -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="links">
                                <h3>Help & Suport</h3>
                                <ul>
                                    <li><a href="faq">FAQ's</a></li>
                                    {{-- <li><a href="#">Support</a></li>
                                <li><a href="#">How it works</a></li> --}}
                                    <li><a href="contact">Contact us</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- footer link 4 -->
                        <div class="col-lg-2 col-md-6 col-12">
                            <div class="try_out">
                                <h3>Let’s Try Out</h3>
                                <ul class="app_btn">
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/images/appstore_blue.png') }}"
                                                alt="image">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/images/googleplay_blue.png') }}"
                                                alt="image">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- row end -->
                </div>
                <!-- container end -->
            </div>

            <!-- last footer -->
            <div class="bottom_footer">
                <!-- container start -->
                <div class="container">
                    <!-- row start -->
                    <div class="row">
                        <div class="col-md-6">
                            <p>© Copyrights 2024. All rights reserved.</p>
                        </div>
                        <div class="col-md-6">
                            <p class="developer_text">Design & developed by <a href="https://www.mypcot.com/"
                                    target="blank">Mypcot Infotech Pvt Ltd</a></p>
                        </div>
                    </div>
                    <!-- row end -->
                </div>
                <!-- container end -->
            </div>

            <!-- go top button -->
            <div class="go_top">
                <span><img src="{{ asset('frontend/images/go_top.png') }}" alt="image"></span>
            </div>
        </footer>
        <!-- Footer-Section end -->

    </div>
    <!-- Page-wrapper-End -->

    <!-- Jquery-js-Link -->
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <!-- owl-js-Link -->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!-- bootstrap-js-Link -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- aos-js-Link -->
    <script src="{{ asset('frontend/js/aos.js') }}"></script>
    <!-- main-js-Link -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>


</body>
</html>
