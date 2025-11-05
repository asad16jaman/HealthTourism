@extends('user.layout.app')
@section('title', 'Service Page')

@push('style')
    <style>
        @media screen and (max-width:1024px){
            .about-area {
                     padding-top: 0px; 
                }
        }
        @media screen and (max-width:500px){
                .header_area + section, .header_area + row, .header_area + div {
                margin-top: 61px;
            }
            .f-18{
                font-size: 18px;
            }
        }
    </style>
@endpush

@section('content')
    @include('user.partial.header', ['page' => 'service'])

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Service</h2>
                    </div>
                    <div class="page_link">
                        <a href="/">Home</a>
                        <a href="#">Service</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================ Service section start =================-->  

    <div class="service-area area-padding-top">
        <div class="container">
            
            <div class="row">

                @forelse($all_service as $service)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card-service text-center text-lg-left mb-4 mb-lg-0">
                            <span class="card-service__icon">
                                <img src="{{ asset('storage/'.$service->img) }}" alt="{{ $service->name }}"
                                class="img-fluid rounded custom_image_style">
                            </span>
                            <h3 class="card-service__title f-18">
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
                    </div>
                @empty

                @endforelse
                



            </div>
        </div>
    </div>    
    <!--================ Service section end =================-->  

    


    @include('user.partial.footer')
@endsection


@push('script')

@endpush