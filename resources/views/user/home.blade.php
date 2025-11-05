@extends('user.layout.app')
@section('title', 'Home Page')

@push('style')
<style>
    .slider_title{
        width:50%;text-align:center;margin:auto;
        background-color: #0707074d;
        padding: 10px;
    }
    .banner_hight{
        height: calc(100vh - 100px);
    }
    .single-banner-item{
        height: calc(100vh - 100px);
    }
   
    @media screen and (min-width:768px) and (max-width:1024px){
        .slider_title{
            width: 70%;
            font-size: 40px!important;
        }
         .single-banner-item {
            height: 30vh;
        }
         .about-area {
            padding-top: 20px;
        }
        .f-md-20{
            font-size: 20px !important;
        }
        .banner_hight{
            height: 283px !important;
        }
    }

    @media screen and (min-width:425px) and (max-width:767px){
        .slider_title{
            width: 70%;
            font-size: 20px!important;
        }
         .single-banner-item {
            height: 50vh;
        }
         .about-area {
            padding-top: 20px;
        }
        .f-md-20{
            font-size: 20px !important;
        }
        .f-sm-18{
            font-size: 18px !important;
        }
    }
     @media screen and (min-width:50px) and (max-width:424px){
        .slider_title{
            width: 70%;
            font-size: 17px!important;
        }
        .header_area + section, .header_area + row, .header_area + div {
            margin-top: 60px;
        }
        .f-sm-18{
            font-size: 18px !important;
        }

        .single-banner-item {
                height: 30vh;
            }
        .about-area {
            padding-top: 20px!important;
        }
        .banner_hight{
            height: 200px !important;
        }
    }
</style>
@endpush

@section('content')

    <!--================Header Menu Area =================-->
     @include('user.partial.header', ['page' => 'home']) 
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <!-- banner-area -->
    <section class="banner_hight">
        <div class="owl-carousel banner-carousel">
            @foreach ($sliders as $slider)
                <div class="single-banner-item"
                    style="background-image: url('{{ asset('storage/'.$slider->img) }}')">
                    <div class="banner-content text-center">
                        <h1 class="slider_title">{{ $slider->description }}</h1>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!--================End Home Banner Area =================-->


    <!--================ Feature section start =================-->
    <section class="feature-section">
        <div class="container">
            <h1 class="text-center text-white mb-5 f-md-20 f-sm-18">WANT US TO ARRANGE EVERYTHING FOR YOU?</h1>
            <div class="row">

                <div class="col-12 col-md-6 col-lg-3 mb-1 mb-lg-0">
                    <div class="card" style="100%">
                        <div class="card-body text-center">
                            <a href="#">
                                <img src="{{ asset('assets/user/contact/phone.png') }}" style="height:40px;width:40px" alt="">
                            <p class="card-text">
                                <small>{{ optional($company)->phone }}</small>{{ optional($company)->phone2 ? "," : ""}}
                                <small>{{ optional($company)->phone2 }}</small>
                            </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 col-lg-3 mb-1 mb-lg-0">
                    <div class="card" style="100%">
                        <div class="card-body text-center">
                            <a href="https://m.me/{{ optional($company)->instagram }}">
                                <img src="{{ asset('assets/user/contact/facebook.png') }}" style="height:40px;width:40px"
                                alt="">
                                <p class="card-text">
                                    <small>MESSAGE US ON FACEBOOK</small>
                                </p>
                                </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3  mb-1 mb-md-0">
                    <div class="card" style="100%">
                        <div class="card-body text-center">
                            <a href="mailto:{{ optional($company)->email }}?subject=Hello%20Team&body=I%20want%20to%20know%20more%20about%20your%20services.">
                                <img src="{{ asset('assets/user/contact/message.png') }}" style="height:40px;width:40px" alt="">
                                <p class="card-text">
                                    <small>MESSAGE US ON EMAIL</small>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card" style="100%">
                        <div class="card-body text-center">
                            <a href="{{ route('pagentReport') }}">
                                <img src="{{ asset('assets/user/contact/file.png') }}" style="height:40px;width:40px" alt="">
                                <p class="card-text">
                                    <small>SUBMIT MEDICAL REPORT</small>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Feature section end =================-->

    <!--================About  Area =================-->
    <section class="about-area">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-6">
                            <img src="{{ asset('storage/'.optional($wellcome)->image_1) }}" alt="">
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="about-content">
                                <h3 style="color: red;text-decoration: underline;" class="mt-2 mt-lg-0 f-md-20 f-sm-18">{{ optional($wellcome)->title }}</h3>
                                <p class="text-justify">
                                    {{ optional($wellcome)->note }}
                                    <a class="link_one wellcome_learn_btn" href="{{ route('about') }}">learn more</a>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================About Area End =================-->

    <!--================ Service section start =================-->
    <section class="team-area area-padding">
        <div class="container">
            <div class="area-heading row">
                <div class="col-md-12">
                    <h3 class="f-md-20 f-sm-18">What we will provide</h3>
                </div>
            </div>
            <div class="team-carousel owl-carousel owl-theme">
                @forelse($all_service as $service)
                    <div class="card-service text-center text-lg-left mb-4 mb-lg-0">
                        <span class="card-service__icon">
                            <img src="{{ asset('storage/'.$service->img) }}" alt="DOCTOR APPOINTMENT"
                                class="img-fluid rounded custom_image_style">
                        </span>
                        <h3 class="card-service__title f-sm-18 f-md-20" style="overflow:hidden">
                            @php
                                $name = substr($service->name,0,26);
                                if(strlen($service->name) > 26){
                                    $name .= "...";
                                }
                            @endphp
                            {{ $name }}
                        </h3>
                        <p class="card-service__subtitle" style="color:#171515">
                            @php
                                $description = substr(strip_tags($service->description),0,60)."...";
                            @endphp
                            {{  $description }}
                        </p>
                        <a class="card-service__link" href="{{ route('service_detail',['uid'=>$service->uid]) }}">Learn More</a>
                    </div>
                @empty
                    <div class="card-service text-center text-lg-left mb-4 mb-lg-0">
                        <h3 class="card-service__title">No Service Found</h3>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('service') }}" class="btn btn-primary">See More</a>
            </div>
        </div>
    </section>
    <!--================ Team section end =================-->

    <!-- ================ Hospital Network Starts ================= -->
    <section class="hotline-area text-center area-padding">
        <div class="container">
            <h2 class="f-sm-18 f-md-20">Our Hospital Network</h2>
            <!-- Brand Carousel Section -->
            <div class="brand-carouselddd owl-carousel owl-theme">
                @foreach ($hospitals as $hospital)
                    <a href="{{ route('hospital.detail',['uid' => $hospital->uid ]) }}">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ asset('storage/'.$hospital->img) }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </a>
                @endforeach              
            </div>
        </div>
    </section>
    <!-- ================ Hotline Area End ================= -->

    <!-- ================ testimonial section start ================= -->
    <section class="testimonial">
        <div class="container py-4">
            <div class="testi_slider owl-carousel owl-theme">
                @foreach ($feedbacks as $feedback)
                    <div class="item">
                        <div class="testi_item">
                            <div class="testimonial_image">
                                <img src="{{ asset('storage/'.$feedback->img) }}" alt="">
                            </div>
                            <div class="testi_item_content">
                                <p>
                                    {{ optional($feedback)->note }}
                                </p>
                                <h4>- {{ optional($feedback)->name }} -</h4>
                            </div>
                        </div>
                    </div>
                @endforeach              
                
            </div>
        </div>
    </section>
    <!-- ================ testimonial section end ================= -->
    <!-- start footer Area -->
     @include('user.partial.footer') 
    <!-- End footer Area -->

@endsection


@push('script')

    <script>

        $(document).ready(function () {
            $('.team-carousel').owlCarousel({
                loop: true,
                margin: 20,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsive: {
                    0: { items: 1 },
                    576: { items: 2 },
                    768: { items: 3 },
                    1024: { items: 4 },
                    1400: { items: 5 },
                }
            });

        });

        $(document).ready(function () {
            $('.brand-carouselddd').owlCarousel({
                loop: true,
                margin: 20,
                nav: false,
                dots: false,
                autoplay: true,
                rtl: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: { items: 1 },
                    576: { items: 2 },
                    768: { items: 3 },
                    1024: { items: 4 },
                    1400: { items: 5 },
                }
            });

            $('.banner-carousel').owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: false,
                smartSpeed: 800,
                dots: false,
                nav: true,
                rtl: false, // right to left slide
                slideTransition: 'linear',
                navText: [
                    '<i class="fa fa-chevron-left"></i>',
                    '<i class="fa fa-chevron-right"></i>'
                ]
            });

        });

        



    </script>

@endpush