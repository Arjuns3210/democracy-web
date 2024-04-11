@extends('frontend/layouts/navd')
@section('content')
    <div class="bred_crumb">
        <div class="container">
            <!-- shape animation  -->
            <span class="banner_shape1"> <img src="{{ asset('frontend/images/banner-shape1.png') }}" alt="image"> </span>
            <span class="banner_shape2"> <img src="{{ asset('frontend/images/banner-shape2.png') }}" alt="image"> </span>
            <span class="banner_shape3"> <img src="{{ asset('frontend/images/banner-shape3.png') }}" alt="image"> </span>

            <div class="bred_text">
                <h1>Contact us</h1>
                <p>If you have an query, please get in touch with us, we will revert back quickly.</p>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><span>»</span></li>
                    <li><a href="contact">Contact us</a></li>
                </ul>
            </div>
        </div>
    </div>


    <!-- Contact Us Section Start -->
    <section class="contact_page_section mb-4">
        <div class="container">
            <div class="contact_inner">
                <div class="contact_form">
                    <div class="section_title">
                        <h2>Leave a <span>message</span></h2>
                        <p>Fill up form below, our team will get back soon</p>
                    </div>
                    <form action="{{ route('contact_us') }}" method="post" id="contactForm">
                        @csrf
                        <div class="form-group">
                            <input type="text" placeholder="Name" name="name" class="form-control"
                                oninput="validateNameInput(this)">
                        </div>
                        <div class="form-group">
                            <input type="phone" placeholder="Phone" name="phone" class="form-control"
                                oninput="validatePhoneInput(this)">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Your message"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn puprple_btn" id="contactBtn">SEND MESSAGE</button>
                        </div>
                    </form>
                </div>
                <div class="contact_info">
                    <div class="icon" style="margin-top: 45px"><img
                            src="{{ asset('frontend/images/contact_message_icon.png') }}" alt="image">
                    </div>
                    <div class="section_title">
                        <h2>Have any <span>question?</span></h2>
                        <p>If you have any question about our product, service, payment or company, Visit our <a
                                href="faq">FAQs page.</a></p>
                    </div>
                    <a href="faq" class="btn puprple_btn">READ FAQ</a>
                    <ul class="contact_info_list">
                        <li>
                            <div class="img">
                                <a href="{{ $contact['insta_link'] }}"><img
                                        src="{{ asset('frontend/images/contact/ig.png') }}" alt="image"></a>
                            </div>
                            <div class="text">

                                <a href="{{ $contact['insta_link'] }}"><span>Explore
                                        Us</span></a>
                            </div>
                        </li>
                        <li>
                            <div class="img">
                                <a href="{{ $contact['yt_link'] }}"><img src="{{ asset('frontend/images/contact/yt.png') }}"
                                        alt="image"></a>
                            </div>
                            <div class="text">

                                <a href="{{ $contact['yt_link'] }}"><span>Watch Us</span></a>
                            </div>
                        </li>
                        <li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us Section End -->
@endsection
