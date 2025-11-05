@extends('user.layout.app')
@section('title', 'About Page')

@push('style')
    <style>
        .about-top-image {
            width: 50%;
            height: auto;
            float: right !important;
            padding: 10px 20px;
            /* background-color: red */
        }

        .about-top-image img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }
        .hospitalImg{
            width: 100%;
            height: 335px;
            object-fit: cover;
        }
        .bg-card{
            background-color: #ffffff;
            padding: 10px 0px;
        }
         @media screen and (max-width:1024px){
           .header_area + section, .header_area + row, .header_area + div {
                margin-top: 60px;
            }
            .f-md-18{
                font-size: 18px;
            }
            .about-area {
                padding-top: 20px !important;
            }

        }
    </style>
@endpush

@section('content')
    @include('user.partial.header', ['page' => 'about'])

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center mt-3 mt-md-5 mt-lg-0">
                    <div class="mb-3 mb-md-0">
                        <h2>Hospital Detail</h2>
                    </div>
                    <div class="page_link">
                        <a href="/">Home</a>
                        <a href="#">Hospital Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================About  Area =================-->
    <section class="about-area">
        <div class="container">
            <div class="row bg-card">
                <div class="col-lg-8 col-md-10 col-12 offset-lg-2 offset-md-1">
                    <div class="card shadow">
                        <div class="card-body">
                            <img src="{{ $hospital->picture ? asset('storage/'.$hospital->picture) : asset('assets/admin/img/no-image.jpg') }}" class="hospitalImg" alt="">
                            <div class="text-justify mt-3">
                                <h3 class="card-title">{{ $hospital->title }}</h3>
                                <p class="lead">
                                    {!! $hospital->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!--================About Area End =================-->




    @include('user.partial.footer')
@endsection


@push('script')

@endpush