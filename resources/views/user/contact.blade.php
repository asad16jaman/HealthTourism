@extends('user.layout.app')
@section('title', 'Contact Page')

@push('style')
  <style>
    .map_url iframe {
      width: 100% !important;
    }
  </style>
@endpush

@section('content')
  @include('user.partial.header', ['page' => 'contact'])

  <!--================Home Banner Area =================-->
  <section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content d-md-flex justify-content-between align-items-center">
          <div class="mb-3 mb-md-0">
            <h2>Contact</h2>
          </div>
          <div class="page_link">
            <a href="/">Home</a>
            <a href="#">Contact Us</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Home Banner Area =================-->

  <!-- ================ contact section start ================= -->
  <section class="contact-section area-padding">
    <div class="container">
      <div class="d-none d-sm-block mb-5 pb-4">
        <div class="map_url" style="height: 480px;">

          {!! optional($company)->map_url !!}

        </div>
      </div>


      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Get in Touch</h2>
        </div>
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <form class="form-contact contact_form" action="" method="post" id="contactForm" novalidate="novalidate">
                @csrf
              <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <textarea class="form-control w-100 @error('message') is-invalid 
                      @enderror" name="message" id="message" cols="30" rows="9"
                        placeholder="Enter Message">{{ old('message') }}</textarea>
                        @error('message')
                          <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input class="form-control @error('name') is-invalid
                      @enderror" name="name" value="{{ old('name') }}" id="name" type="text" placeholder="Enter your name">
                      @error('name')
                          <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input class="form-control @error('email') is-invalid
                      @enderror" name="email" value="{{ old('email') }}" id="email" type="email" placeholder="Enter email address">
                      @error('email')
                          <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <input class="form-control @error('subject') is-invalid
                      @enderror" value="{{ old('subject') }}"  name="subject" id="subject" type="text" placeholder="Enter Subject">
                      @error('subject')
                          <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <button type="submit" class="button button-contactForm">Send Message</button>
                </div>
              </form>
            </div>
          </div>


        </div>

        <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              {{ optional($company)->address }}
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3>
                <a
                  href="tel:{{ optional($company)->phone }}">{{ optional($company)->phone }}</a>{{ optional($company)->phone2 ? " , " : "" }}
                <a href="tel:{{ optional($company)->phone2 }}">{{ optional($company)->phone2 }}</a>
              </h3>

            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3><a href="mailto:{{ optional($company)->email }}">{{ optional($company)->email }}</a></h3>
              <p>Send us your query anytime!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->

  @include('user.partial.footer')

  {{--  Success Modal --}}
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

{{--  Error Modal --}}
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
  $(document).ready(function() {
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