@extends('frontend/layouts/navl')
@section('content')
    <!-- Banner-Section-Start -->
    <section class="banner_section">
        <!-- container start -->
        <div class="container">
            <!-- vertical animation line -->
            <div class="anim_line">
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
            <!-- row start -->
            <div class="row">
                <div class="col-lg-6 col-md-12" data-aos="fade-right" data-aos-duration="1500">
                    <!-- banner text -->
                    <div class="banner_text">
                        <!-- h1 -->
                        <h1>Explore <span>Your Passion for Cinema.</span></h1>
                        <!-- p -->
                        <p>Are you a true cinephile? Do you pride yourself on your knowledge of movies and films? Look no
                            further! Seeta Films presents an immersive experience designed just for you.
                        </p>
                    </div>
                    <!-- app buttons -->
                    <ul class="app_btn">
                        <li>
                            <a href="{{ route('home') }}">
                                <img class="blue_img" src="{{ asset('frontend/images/appstore_blue.png') }}"
                                    alt="image">
                                <img class="white_img" src="{{ asset('frontend/images/appstore_white.png') }}"
                                    alt="image">
                            </a>
                        </li>
                        <li>
                            <a href="{{ config('global.ios_link') }}">
                                <img class="blue_img" src="{{ asset('frontend/images/googleplay_blue.png') }}"
                                    alt="image">
                                <img class="white_img" src="{{ asset('frontend/images/googleplay_white.png') }}"
                                    alt="image">
                            </a>
                        </li>
                    </ul>

                    <!-- users -->
                    <div class="used_app">
                        <ul>
                            <li><img src="{{ asset('frontend/images/used01.png') }}" alt="image"></li>
                            <li><img src="{{ asset('frontend/images/used02.png') }}" alt="image"></li>
                            <li><img src="{{ asset('frontend/images/used03.png') }}" alt="image"></li>
                            <li><img src="{{ asset('frontend/images/used04.png') }}" alt="image"></li>
                        </ul>
                        <p>12M + <br> used this app</p>
                    </div>
                </div>

                <!-- banner slides start -->
                <div class="col-lg-6 col-md-12" data-aos="fade-in" data-aos-duration="1500">
                    <div class="banner_slider">
                        <div class="left_icon">
                            <img src="{{ asset('frontend/images/message_icon.png') }}" alt="image">
                        </div>
                        <div class="right_icon">
                            <img src="{{ asset('frontend/images/shield_icon.png') }}" alt="image">
                        </div>
                        <div id="frmae_slider" class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{ asset('frontend/images/home/Home1.png') }}" class="py-1" alt="image">
                                </div>
                            </div>
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{ asset('frontend/images/home/quiz_screen1.png') }}" class="py-1"
                                        alt="image">
                                </div>
                            </div>
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{ asset('frontend/images/home/quiz_complete1.png') }}" class="py-1"
                                        alt="image">
                                </div>
                            </div>
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{ asset('frontend/images/home/quiz_interactive1.png') }}" class="py-1"
                                        alt="image">
                                </div>
                            </div>
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{ asset('frontend/images/home/rewards1.png') }}" class="py-1"
                                        alt="image">
                                </div>
                            </div>
                        </div>
                        <div class="slider_frame">
                            <img src="{{ asset('frontend/images/mobile_frame_svg.svg') }}" alt="image">
                        </div>
                    </div>
                </div>
                <!-- banner slides end -->

            </div>
            <!-- row end -->
        </div>
        <!-- container end -->
    </section>
    <!-- Banner-Section-end -->
    <!-- Features-Section-Start -->
    <section class="row_am features_section" id="features">
        <!-- container start -->
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                <!-- h2 -->
                <h2><span>Features</span> that makes app different!</h2>
                <!-- p -->
                <p>At Seeta Films, we've crafted a movie and film quiz app that stands out from the crowd. Here's why users
                    love us:</p>
            </div>
            <div class="feature_detail">
                <!-- feature box left -->
                <div class="left_data feature_box">

                    <!-- feature box -->
                    <div class="data_block" data-aos="fade-right" data-aos-duration="1500">
                        <div class="icon">
                            <img src="{{ asset('frontend/images/secure_data.png') }}" alt="image">
                        </div>
                        <div class="text">
                            <h4>Multiplayer Thrills</h4>
                            <p>Engage in real-time multiplayer quizzes, adding excitement and social interaction to your
                                movie trivia adventures.</p>
                        </div>
                    </div>

                    <!-- feature box -->
                    <div class="data_block" data-aos="fade-right" data-aos-duration="1500">
                        <div class="icon">
                            <img src="{{ asset('frontend/images/functional.png') }}" alt="image">
                        </div>
                        <div class="text">
                            <h4>Diverse Quiz Categories</h4>
                            <p>Explore a variety of topics, from classics to current releases, catering to every movie
                                enthusiast's interests.</p>
                        </div>
                    </div>
                </div>

                <!-- feature box right -->
                <div class="right_data feature_box">

                    <!-- feature box -->
                    <div class="data_block" data-aos="fade-left" data-aos-duration="1500">
                        <div class="icon">
                            <img src="{{ asset('frontend/images/live-chat.png') }}" alt="image">
                        </div>
                        <div class="text">
                            <h4>Compete Globally</h4>
                            <p>Test your knowledge on global leaderboards, challenging friends and users worldwide for
                                ultimate bragging rights.</p>
                        </div>
                    </div>

                    <!-- feature box -->
                    <div class="data_block" data-aos="fade-left" data-aos-duration="1500">
                        <div class="icon">
                            <img src="{{ asset('frontend/images/support.png') }}" alt="image">
                        </div>
                        <div class="text">
                            <h4>Personalized Recommendations</h4>
                            <p>Receive tailored movie suggestions based on quiz performance, ensuring a curated viewing
                                experience.</p>
                        </div>
                    </div>

                </div>
                <!-- feature image -->
                <div class="feature_img" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                    <img src="{{ asset('frontend/images/home/details.png') }}" alt="image">
                </div>
            </div>
        </div>
        <!-- container end -->
    </section>
    <!-- Features-Section-end -->

    <!-- About-App-Section-Start -->
    <section class="row_am about_app_section">
        <!-- container start -->
        <div class="container">
            <!-- row start -->
            <div class="row">
                <div class="col-lg-6">

                    <!-- about images -->
                    <div class="about_img" data-aos="fade-in" data-aos-duration="1500">
                        <div class="frame_img">
                            <img class="moving_position_animatin" src="{{ asset('frontend/images/home/contest.png') }}"
                                alt="image">
                        </div>
                        <div class="screen_img">
                            <img class="moving_animation" src="{{ asset('frontend/images/something.png') }}"
                                alt="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <!-- about text -->
                    <div class="about_text">
                        <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">

                            <!-- h2 -->
                            <h2>Experience Cinematic Brilliance <span>about app.</span></h2>

                            <!-- p -->
                            <p>
                                Join over 7 lakhs users worldwide who have embraced our app as their go-to destination for
                                all things movies. With a massive community of over 10 lakhs followers, our platform is
                                where film enthusiasts unite.
                            </p>
                        </div>

                        <!-- UL -->
                        <ul class="app_statstic" id="counter" data-aos="fade-in" data-aos-duration="1500">
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/download.png') }}" alt="image">
                                </div>
                                <div class="text">
                                    <p><span class="counter-value" data-count="10">0</span><span>T+</span></p>
                                    <p>Download</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/followers.png') }}" alt="image">
                                </div>
                                <div class="text">
                                    <p><span class="counter-value" data-count="08">0 </span><span>k+</span></p>
                                    <p>Followers</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/reviews.png') }}" alt="image">
                                </div>
                                <div class="text">
                                    <p><span class="counter-value" data-count="600">100</span><span>+</span></p>
                                    <p>Reviews</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/countries.png') }}" alt="image">
                                </div>
                                <div class="text">
                                    <p><span class="counter-value" data-count="150">0</span><span>+</span></p>
                                    <p>Countries</p>
                                </div>
                            </li>
                        </ul>
                        <!-- UL end -->
                        <a href="{{ config('global.app_link') }}
                        " class="btn puprple_btn"
                            data-aos="fade-in" data-aos-duration="1500">DOWNLOAD NOW</a>
                    </div>
                </div>
            </div>
            <!-- row end -->
        </div>
        <!-- container end -->
    </section>
    <!-- About-App-Section-end -->

    <!-- How-It-Workes-Section-Start -->
    <section class="row_am how_it_works" id="how_it_work">
        <!-- container start -->
        <div class="container">
            <div class="how_it_inner">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                    <!-- h2 -->
                    <h2><span>How it works</span> - 3 easy steps</h2>
                    <!-- p -->
                    <p>Dive in and experience the most amazing features our app has to offer.</p>
                </div>
                <div class="step_block">
                    <!-- UL -->
                    <ul>
                        <!-- step -->
                        <li>
                            <div class="step_text" data-aos="fade-right" data-aos-duration="1500">
                                <h4>Download app</h4>
                                <div class="app_icon">
                                    <a href="#"><i class="icofont-brand-android-robot"></i></a>
                                    <a href="#"><i class="icofont-brand-apple"></i></a>
                                    <a href="#"><i class="icofont-brand-windows"></i></a>
                                </div>
                                <p>Download App either for Windows, Mac or Android</p>
                            </div>
                            <div class="step_number">
                                <h3>01</h3>
                            </div>
                            <div class="step_img" data-aos="fade-left" data-aos-duration="1500">
                                <img src="{{ asset('frontend/images/download_app.jpg') }}" alt="image">
                            </div>
                        </li>

                        <!-- step -->
                        <li>
                            <div class="step_text" data-aos="fade-left" data-aos-duration="1500">
                                <h4>Create account</h4>
                                <p>Sign up free for App account. One account for all devices.</p>
                            </div>
                            <div class="step_number">
                                <h3>02</h3>
                            </div>
                            <div class="step_img" data-aos="fade-right" data-aos-duration="1500">
                                <img src="{{ asset('frontend/images/create_account.jpg') }}" alt="image">
                            </div>
                        </li>

                        <!-- step -->
                        <li>
                            <div class="step_text" data-aos="fade-right" data-aos-duration="1500">
                                <h4>It’s done, enjoy the app</h4>
                                <span>Have any questions check our <a href="faq">FAQs</a></span>
                                <p>Get most amazing app experience,Explore and share the app</p>
                            </div>
                            <div class="step_number">
                                <h3>03</h3>
                            </div>
                            <div class="step_img" data-aos="fade-left" data-aos-duration="1500">
                                <img src="{{ asset('frontend/images/enjoy_app.jpg') }}" alt="image">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- container end -->
    </section>
    <!-- How-It-Workes-Section-end -->

    <!-- FAQ-Section start -->
    <section class="row_am faq_section">
        <!-- container start -->
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                <!-- h2 -->
                <h2><span>FAQ</span> - Frequently Asked Questions</h2>
                <!-- p -->
                <p>For more information or specific inquiries, please don't hesitate to reach out to our customer support
                    team.</p>
            </div>
            <!-- faq data -->
            <div class="faq_panel">
                <div class="accordion" id="accordionExample">

                    @foreach ($faqContent as $item)
                        <div class="card" data-aos="fade-up" data-aos-duration="1500">
                            <div class="card-header" id="heading{{ $item['id'] }}">
                                <h2 class="mb-0">
                                    <button type="button" class="btn btn-link active" data-toggle="collapse"
                                        data-target="#collapse{{ $item['id'] }}">
                                        <i class="icon_faq icofont-plus"></i></i> {{ $item['question'] }}</button>
                                </h2>
                            </div>
                            <div id="collapse{{ $item['id'] }}" class="collapse show"
                                aria-labelledby="heading{{ $item['id'] }}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>{{ $item['answer'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- container end -->
    </section>
    <!-- FAQ-Section end -->

    <!-- Beautifull-interface-Section start -->
    <section class="row_am interface_section">
        <!-- container start -->
        <div class="container-fluid">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                <!-- h2 -->
                <h2>Beautifull <span>interface</span></h2>
                <!-- p -->
                <p>
                    Experience the elegance of our app's beautiful interface
                </p>
            </div>

            <!-- screen slider start -->
            <div class="screen_slider">
                <div id="screen_slider" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="screen_frame_img">
                            <img src="{{ asset('frontend/images/home/carousel/1.png') }}" alt="image">
                        </div>
                    </div>
                    <div class="item">
                        <div class="screen_frame_img">
                            <img src="{{ asset('frontend/images/home/carousel/2.png') }}" alt="image">
                        </div>
                    </div>
                    <div class="item">
                        <div class="screen_frame_img">
                            <img src="{{ asset('frontend/images/home/carousel/3.png') }}" alt="image">
                        </div>
                    </div>
                    <div class="item">
                        <div class="screen_frame_img">
                            <img src="{{ asset('frontend/images/home/carousel/4.png') }}" alt="image">
                        </div>
                    </div>
                    <div class="item">
                        <div class="screen_frame_img">
                            <img src="{{ asset('frontend/images/home/carousel/5.png') }}" alt="image">
                        </div>
                    </div>
                    <div class="item">
                        <div class="screen_frame_img">
                            <img src="{{ asset('frontend/images/home/carousel/6.png') }}" alt="image">
                        </div>
                    </div>

                </div>
            </div>
            <!-- screen slider end -->
        </div>
        <!-- container end -->
    </section>
    <!-- Beautifull-interface-Section end -->

    <!-- Download-Free-App-section-Start  -->
    <section class="row_am free_app_section" id="getstarted">
        <!-- container start -->
        <div class="container">
            <div class="free_app_inner" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="100">
                <!-- vertical line animation -->
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
                <!-- row start -->
                <div class="row">
                    <!-- content -->
                    <div class="col-md-6">
                        <div class="free_text">
                            <div class="section_title">
                                <h2>Let’s download free from apple and play store</h2>
                                <p>Unlock the magic of cinema - Download now and embark on an unforgettable journey!</p>
                            </div>
                            <ul class="app_btn">
                                <li>
                                    <a href="{{ config('global.app_link') }}">
                                        <img src="{{ asset('frontend/images/appstore_blue.png') }}" alt="image">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ config('global.ios_link') }}">
                                        <img src="{{ asset('frontend/images/googleplay_blue.png') }}" alt="image">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- images -->
                    <div class="col-md-6">
                        <div class="free_img">
                            <img src="{{ asset('frontend/images/home/carousel/Reward.png') }}" alt="image">
                            <img class="mobile_mockup" src="{{ asset('frontend/images/home/carousel/Home.png') }}"
                                alt="image">
                        </div>
                    </div>
                </div>
                <!-- row end -->
            </div>
        </div>
        <!-- container end -->
    </section>
    <!-- Download-Free-App-section-end  -->
@endsection
