@extends('frontend/layouts/navd')
@section('content')
    <!-- BredCrumb-Section -->
    <div class="bred_crumb">
        <div class="container">
            <!-- shape animation  -->
            <span class="banner_shape1"> <img src="{{ asset('frontend/images/banner-shape1.png') }}" alt="image">
            </span>
            <span class="banner_shape2"> <img src="{{ asset('frontend/images/banner-shape2.png') }}" alt="image">
            </span>
            <span class="banner_shape3"> <img src="{{ asset('frontend/images/banner-shape3.png') }}" alt="image"> </span>

            <div class="bred_text">
                <h1>Have questions? Find answers here.</h1>
                <p>For more information or specific inquiries, please don't hesitate to reach out to our customer support
                    team.</p>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><span>»</span></li>
                    <li><a href="faq">Faq</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- FAQ-Section start -->
    <section class="row_am faq_section">
        <!-- container start -->
        <div class="container">

            <!-- faq data -->
            <div class="faq_panel">
                <div class="accordion" id="accordionExample">
                    @foreach ($faqContent as $item)
                        <div class="card" data-aos="fade-up">
                            <div class="card-header" id="heading{{ $item['id'] }}">
                                <h2 class="mb-0">
                                    <button type="button" class="btn btn-link" data-toggle="collapse"
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

    <!-- Download-Free-App-section-Start  -->
    <section class="row_am free_app_section review_freeapp" id="getstarted">
        <!-- container start -->
        <div class="container">
            <div class="free_app_inner" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="100">
                <!-- row start -->
                <div class="row">
                    <!-- content -->
                    <div class="col-md-6">
                        <div class="free_text">
                            <div class="section_title">
                                <h2>Let’s download free from apple and play store</h2>
                                <p>Unlock the magic of cinema - Download now and embark on an unforgettable journey! </p>
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
