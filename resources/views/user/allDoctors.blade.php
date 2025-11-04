@extends('user.layout.app')
@section('title', 'Service Page')

@push('style')
    <style>
        .doctor_img{
            height: 204px;
            width: 100%;
            object-fit: contain;
        }
        .doctor_card_btn{
            background: linear-gradient(45deg, black, #2777a7);
            color: #fff;
            padding: 6px 13px;
        }

        .doctor_card {
            overflow: hidden; /* zoom effect এর সময় img বের হয়ে না আসে */
        }

        .doctor_img {
            height: 204px;
            width: 100%;
            object-fit: contain;
            transition: transform 0.4s ease-in-out; /* smooth zoom animation */
        }

        .doctor_card:hover .doctor_img {
            transform: scale(1.1); /* zoom-in effect */
        }
        .doctor_card_btn:hover{
             background: linear-gradient(45deg, #d81176, #0052d2) !important;
            color: #fff;
            transition:0.5;
        }

    </style>
@endpush

@section('content')
    @include('user.partial.header', ['page' => 'doctor'])

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>All Doctors</h2>
                    </div>
                    <div class="page_link">
                        <a href="/">Home</a>
                        <a href="#">Doctors</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================ Service section start =================-->  

    <div class="service-area area-padding-top">
        <div class="container py-2">
            
            <div class="row">
             
                @forelse($datas as $data)
                    <div class="col-12 col-md-4 col-lg-3 mb-4">
                        <a href="{{ route('doctor.detail',['uid' => $data->uid]) }}">
                            <div class="card card-team shadow doctor_card" style="border : 1px solid #0052d2;">
                                <img class="doctor_img rounded-0" src="{{ $data->img ? asset('storage/'.$data->img) : asset('assets/user/img/banner/about1.png') }}" alt="">
                                <div class="card-team__body text-center">
                                    <h3 style="height:48px"><a type="button">{{ $data->name }}</a></h3>
                                    <p style="margin-bottom:6px">{{ $data->designation }}</p>
                                <a href="{{ route('doctor.detail',['uid' => $data->uid]) }}" class="doctor_card_btn">See Details</a>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    There is no Doctor
                @endforelse
                

                

                
                
                
            </div>
        </div>
    </div>    
    <!--================ Service section end =================-->  

    


    @include('user.partial.footer')
@endsection


@push('script')

@endpush