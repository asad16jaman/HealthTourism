@extends('user.layout.app')
@section('title', 'Service Detail Page')

@push('style')
    <style>
        .about-top-image {
            width: 40%;
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
        @media screen and (min-width:768px) and (max-width:1024px) {
            .about-top-image {
                width: 50%;
            }
        }
         @media screen and (max-width:1024px){
           .header_area + section, .header_area + row, .header_area + div {
                margin-top: 60px;
            }
            .f-md-18{
                font-size: 18px!important;
            }
                .about-area {
                padding-top: 0px;
            }
        }
        @media screen and (max-width:767px) {
            .about-top-image {
                width: 100%;
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
                        <h2>Service Detail</h2>
                    </div>
                    <div class="page_link">
                        <a href="/">Home</a>
                        <a href="#">Service Detail</a>
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
                    <h2 class="comon-heading m-0 text-center mb-3 f-md-18">{{ optional($s_detail)->name }} </h2>
                    <div class="about-top-image">
                        <img src="{{ asset('storage/' . $s_detail->img) }}" alt="pic">
                    </div>

                    <p class="mt-2" style="text-align: justify;">
                        {!! optional($s_detail)->description !!}
                    </p>

                </div>
            </div>
        </div>
    </section>
    <!--================About Area End =================-->

    <!--================ appointment Area Starts =================-->
    <section class="appointment-area area-padding">
        <div class="container">

            <div class="appointment-inner">
                <div class="row">
                    <div class="col-sm-12 col-lg-5 offset-lg-1">
                        <h3 class="f-md-18">Some Common Questions?</h3>
                        <div class="accordion" id="accordionExample">
                            @foreach ($faqs as $faq)
                                @if($loop->first)
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $faq->id }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapse{{ $faq->id }}" aria-expanded="false"
                                                    aria-controls="collapse{{ $faq->id }}">
                                                    {{ $faq->question }}
                                                </button>

                                            </h5>
                                        </div>

                                        <div id="collapse{{ $faq->id }}" class="collapse {{ $loop->iteration == 1 ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $faq->id }}" data-parent="#accordionExample">
                                            <div class="card-body">
                                                {{ $faq->answer }}
                                            </div>
                                        </div>
                                    </div>

                                @else
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $faq->id }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapse{{ $faq->id }}" aria-expanded="false"
                                                    aria-controls="collapse{{ $faq->id }}">
                                                    {{ $faq->question }}
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                {{ $faq->answer }}
                                            </div>
                                        </div>
                                    </div>

                                @endif

                            @endforeach



                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="appointment-form p-3" style="border: 1px dotted blue;">
                            <h3 class="f-md-18">Have Any Questions?</h3>
                            <form action="#" method="post">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $s_detail->id }}">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="@error('name') is-invalid
                                    @enderror" placeholder="Your Name" required>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="phone" class="@error('phone') is-invalid
                                    @enderror" placeholder="Your Email" required>
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message" class="@error('message') is-invalid
                                    @enderror" cols="10" rows="3" placeholder="Message" required></textarea>
                                    @error('message')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="main_btn">Sand</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </section>
    <!--================ appointment Area End =================-->




    @include('user.partial.footer')

    {{-- Success Modal --}}
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-success">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Error Modal --}}
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-danger">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function () {
            //  success session 
            @if (session('success'))
                $('#successModal').modal('show');
            @endif

            // error session 
            @if (session('error'))
                $('#errorModal').modal('show');
            @endif
      });
    </script>
@endpush