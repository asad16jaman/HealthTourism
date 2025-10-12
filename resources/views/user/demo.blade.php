@extends('user.layout.app')
@section('title', 'About Page')

@push('style')
    <style>
        
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
                        <a href="index.html">Home</a>
                        <a href="contact.html">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    




    @include('user.partial.footer')
@endsection


@push('script')

@endpush