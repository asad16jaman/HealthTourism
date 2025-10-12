@extends('user.layout.app')
@section('title', 'Report Page')

@push('style')
    
@endpush

@section('content')
    @include('user.partial.header', ['page' => 'report'])

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Report</h2>
                    </div>
                    <div class="page_link">
                        <a href="/">Home</a>
                        <a href="#">Submit Report</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!-- ================ contact section start ================= -->
    <section class="contact-section area-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 ">

                    <div class="card">
                        <div class="card-body p-5">
                            <h3 class="mg-md text-center"> Patients Report Submission </h3>
                            <form enctype="multipart/form-data" action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label> Patients Name </label>
                                    <input id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required="">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Address<br> </label>
                                    <input name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" required="" id="address">
                                     @error('address')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label> City<br> </label>
                                    <input name="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" required="" id="city" autocomplete="off">
                                     @error('city')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label> Upload your reports (PDF or Doc file only): </label> <br>
                                    <input name="files" type="file">
                                     @error('files')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label> Email </label>
                                    <input id="aemail" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" type="email" name="email" required="">
                                     @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label> Message (if any) </label>
                                    <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror" rows="4" cols="50"
                                        required="">{{ old('message') }}</textarea>
                                     @error('message')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-center d-flex justify-content-end"> 
                                    <button class="btn btn-primary" type="submit"> Submit </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->

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