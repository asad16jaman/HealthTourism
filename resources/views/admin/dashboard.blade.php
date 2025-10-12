@extends('admin.layout.app')

@section('title', 'Admin Page')

@section('pageside')
  @include('admin.layout.sidebar',['page' => 'home'])
@endsection
@section('style')
  <style>
    .d_icon{
          font-size: 36px;
          margin-bottom: 0px;
          line-height: 0;
    }
  </style>
@endsection

@section('bodyContent')

<div class="container">

          <div class="page-inner">
            <div class="d-flex align-items-center justify-content-center align-items-md-center flex-column flex-md-row pt-2 pb-4">
              <div >
                <div class="card mb-1">
                  <div class="card-body d-flex justify-content-center">
                      <img src="{{ optional($company)->logo ? asset('storage').'/'.$company->logo : "" }}" style="width:70px;height:55px" alt="">
                  </div>
                </div>
                <h3 class="fw-bold mb-3 text-center">{{ optional($company)->name }}</h3>
              
              </div>
            </div>
            <div class="row">
                  <div class="col-xl-3 col-md-6">
                    <a href="{{ route('admin.users') }}">
                        <div class="card" style="background:#ebf8ff">
                          <div class="card-body text-center">
                              <p class="d_icon"><i class="fas fa-users"></i></p>
                              <h4>Users</h4>
                          </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('admin.service') }}">
                        <div class="card" style="background:#fffbeb">
                          <div class="card-body text-center">
                              <p class="d_icon"><i class="fas fa-project-diagram"></i></p>
                              <h4>Service</h4>
                          </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('admin.client') }}">
                        <div class="card" style="background:#f5f3ff">
                          <div class="card-body text-center">
                              <p class="d_icon"><i class="fas fa-project-diagram"></i></p>
                              <h4>Hospital</h4>
                          </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('admin.slider') }}">
                        <div class="card" style="background:#fdf2f8	">
                          <div class="card-body text-center">
                              <svg style="width:31px" class="svg-inline--fa fa-sliders-h fa-w-16 fa-2x" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sliders-h" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M496 384H160v-16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h80v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h336c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm0-160h-80v-16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h336v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h80c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm0-160H288V48c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16C7.2 64 0 71.2 0 80v32c0 8.8 7.2 16 16 16h208v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h208c8.8 0 16-7.2 16-16V80c0-8.8-7.2-16-16-16z"></path></svg>
                              <h4>Slider</h4>
                          </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('admin.apoint') }}">
                        <div class="card" style="background: #f0fdfa">
                          <div class="card-body text-center">
                              <p class="d_icon"><i class="fas fa-check-circle"></i></p>
                              <h4>Booking</h4>
                          </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('admin.report') }}">
                        <div class="card" style="background:#f0fdf4	">
                          <div class="card-body text-center">
                              <p class="d_icon"><i class="fas fa-feather-alt"></i></p>
                              <h4>Report</h4>
                          </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('admin.message') }}">
                        <div class="card" style="background:#eef2ff	">
                          <div class="card-body text-center">
                              <p class="d_icon"><i class="fas fa-envelope"></i></p>
                              <h4>Message</h4>
                          </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('admin.logout') }}">
                        <div class="card" style="background:#f9d4d4	">
                          <div class="card-body text-center">
                              <p class="d_icon"><i class="fas fa-share"></i></p>
                              <h4>Logout</h4>
                          </div>
                        </div>
                    </a>
                </div>
            </div>
          </div>
        </div>

@endsection


