@extends('frontend/layouts/navl')
@section('content')
    <!-- BredCrumb-Section -->
    <div class="bred_crumb blog_detail_bredcrumb" style="background:#fbfaff;">
        <div class="container">
            <div class="bred_text">
                <h1 style="color: var(--body-text-purple);">Terms & Conditions</h1>
                <ul>
                    <li><a style="color: var(--body-text-purple);" href="/">Home</a></li>
                    <li><span style="color: var(--body-text-purple);">»</span></li>
                    <li><a style="color: var(--body-text-purple);" href="terms"> Terms & Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Terms & Conditions Block -->
    <section class="blog_detail_section">
        <div class="container">
            <div class="blog_inner_pannel text-left">
                <div class="text-left info section_title">
                    <h3>Terms & Conditions</h3>
                    <p>{!! $termsContent !!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
