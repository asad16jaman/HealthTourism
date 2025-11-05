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
        @media screen and (max-width:1024px){
            .about-area {
                     padding-top: 0px; 
                }
        }
        @media screen and (max-width:500px){
                .header_area + section, .header_area + row, .header_area + div {
                margin-top: 61px;
            }
            .about-top-image {
                width: 100%;
                padding: 10px 20px;
            }
            .f-18{
                font-size: 18px;
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
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>About Us</h2>
                    </div>
                    <div class="page_link">
                        <a href="/">Home</a>
                        <a href="#">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->
    <!--================About  Area =================-->
    <section class="about-area">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 g-lg-5">
                <div class="col-12 py-3" style="text-align: justify;">
                    {{-- <h5 class="samll-sub mb-1 mt-0"> Our Story </h5> --}}
                    <h2 class="comon-heading m-0 text-center mb-3 f-18">{{ optional($aboutdetail)->title }} </h2>
                    <div class="about-top-image">
                        <img src="{{ asset('storage/'.$aboutdetail->picture) }}" alt="pic">
                    </div>

                    <p class="mt-2" style="text-align: justify;">
                       {!! optional($aboutdetail)->about !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--================About Area End =================-->
    @include('user.partial.footer')
@endsection
@push('script')

@endpush