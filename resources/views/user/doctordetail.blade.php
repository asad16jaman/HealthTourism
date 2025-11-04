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
        .detail-card{}
        .detail-card h1{
            font-size: 25px;
        }
        .detail-card h3{
           
        }
        .detail-card h3 i{
            font-size: 17px;
        }
        .detail-card h3 span{
             font-size: 18px;
            margin-left: 12px;
            color: #494545;
        }
        .statusbar{
            padding: 9px 10px;
            background: #a7dadc;
        }
        .activesd{
            background-color: #0052d2;
            color: #fff;
            padding: 0px 10px;
        }
        .inactive{
            background-color: red;
            color: #fff;
            padding: 0px 10px;
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
                        <h2>Doctor Detail</h2>
                    </div>
                    <div class="page_link">
                        <a href="/">Home</a>
                        <a href="#">Detail</a>
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
                <div class="col-md-6 col-lg-4 col-12">
                    <div class="card detail-card shadow" style="border-top : 4px solid #007144;">
                        <img src="{{ $doctor->img ? asset('storage/'.$doctor->img) : asset('assets/user/img/banner/about1.png') }}" alt="">
                        <div class="p-3">
                            <h1>{{ $doctor->name }}</h1>
                            <h3><i class="ti-briefcase"></i> <span>{{ $doctor->designation }}</span></h3>
                            <div class="d-flex justify-content-between statusbar">
                                <span>Status</span>
                                <span class="{{ $doctor->status ? 'activesd' : 'inactive' }}">{{ $doctor->status ? "Active" : "Inactive" }}</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6 col-lg-8 col-12">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3>Detail</h3>
                            <div style="width:200px">
                                <p  style="margin-bottom:0px">
                                    <i class="ti-email "></i>
                                    <span style="margin-left:9px">Email</span>
                                </p>
                                <p style="margin-bottom:0px">{{ $doctor->email ?? "Email not available" }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $doctor->detail !!}
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