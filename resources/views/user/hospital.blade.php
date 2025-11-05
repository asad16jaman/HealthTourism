@extends('user.layout.app')
@section('title', 'Hospital Page')

@push('style')
    <style>
        .card_shadow{
            box-shadow: 0px 0px 3px 1px #000000c7;
        }

        @media screen and (max-width:1024px){
           .header_area + section, .header_area + row, .header_area + div {
                margin-top: 60px;
            }
            .f-md-18{
                font-size: 18px;
            }
        }
    </style>
@endpush

@section('content')
    @include('user.partial.header', ['page' => 'hospital'])

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center mt-3 mt-md-5 mt-lg-0">
                    <div class="mb-3 mb-md-0">
                        <h2>Hospital</h2>
                    </div>
                    <div class="page_link">
                        <a href="/">Home</a>
                        <a href="#">Hospital</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

   <!--================ Feature section start =================-->
    <section class="feature-section">
        <div class="container">
            <h1 class="text-center text-white mb-5 f-md-18">WANT US TO ARRANGE EVERYTHING FOR YOU?</h1>
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
                <div class="col-12 col-md-6 col-lg-3 mb-1 mb-lg-0">
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
                <div class="col-12 col-md-6 col-lg-3 mb-1 mb-md-0">
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

    <section class="contact-section area-padding">
        <div class="container">
            @forelse($countries as $country)
                @if($country->hashospital())
                <h1 style="text-align: center;font-weight:400" class="mb-3 f-md-18">Our Hospital Network In {{ $country->country }}</h1>
                    <div class="row mb-4">
                            @foreach ($country->hospitals as $hospital)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                                <a href="{{ route('hospital.detail',['uid' => $hospital->uid ]) }}">
                                    <div class="card card_shadow">
                                        <div class="card-body">
                                            <img src="{{ asset('storage/'.$hospital->img) }}" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        
                    </div>
                @endif
            @empty
                <p>There is no hospital</p>
            @endforelse
            
        </div>
    </section>

    @include('user.partial.footer')
@endsection


@push('script')

@endpush