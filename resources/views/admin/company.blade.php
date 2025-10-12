@extends('admin.layout.app')

@section('title', 'Admin Page')

@section('style')
<style>
    
 .profileImg{
        width: auto;
        height: 100px; 
        object-fit: cover;
        border: 2px dashed #ccc;
        border-radius: 6px;
    }
</style>
@endsection



@section('bodyContent')


    <div class="container">
        <div class="page-inner">
            <div class="card">
                <div class="card-header pt-1 pb-0">
                    <h4 class="text-center">Company Detail</h4>
                </div>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-3 ">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="email2">Org. Name :</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control p-1 @error('name') is-invalid @enderror"  name="name" value="{{ old('name',optional($company)->name)}}"
                                            placeholder="Enter Company Name">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="email">Email :</label> 
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="email" class="form-control p-1 @error('email') is-invalid @enderror"  name="email" value="{{ old('email',optional($company)->email)}}"
                                            placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="email2">Email 2 :</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="email" value="{{ old('email2',optional($company)->email2)}}" name="email2" class="form-control p-1 @error('email2') is-invalid @enderror" id="" placeholder="Enter Second Email">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="phone">Phone :</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="text" value="{{ old('phone',optional($company)->phone)}}" name="phone" class="form-control p-1 @error('phone') is-invalid @enderror" id="" placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="phone">Phone 2 :</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="text" value="{{ old('phone2',optional($company)->phone2) }}" name="phone2" class="form-control p-1 @error('phone2') is-invalid @enderror" id="" placeholder="Enter Phone 2">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="phone">Footer Text :</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <textarea class="form-control @error('footer_text') is-invalid @enderror" name="footer_text" id="comment" rows="6">{{ old('footer_text',optional($company)->footer_text) }}</textarea>
                                         @error('footer_text')
                                            <p>{{ $message }}</p>
                                         @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <label for="password">Facebook :</label>
                                    </div>
                                    <div class="col-md-9 col-12">
                                          <input type="text" value="{{ old('facebook',optional($company)->facebook) }}" class="form-control p-1 @error('facebook') is-invalid @enderror" name="facebook" placeholder="Enter facebook Link">
                                    </div>
                                    @error('facebook')
                                        <p class="text-danger text-end">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row mb-2">
                                    <!-- //Instagram is replased by whatsapp  -->
                                    <div class="col-md-3 col-12">
                                        <label for="password">Messanger :</label>
                                    </div>
                                    <div class="col-md-9 col-12">
                                          <input type="text" class="form-control p-1 @error('instagram') is-invalid @enderror" value="{{ old('instagram',optional($company)->instagram) }}" name="instagram" placeholder="Enter Profile Code">
                                    </div>
                                    @error('instagram')
                                        <p class="text-danger text-end">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <label for="password">Twiter :</label>
                                    </div>
                                    <div class="col-md-9 col-12">
                                          <input type="text" class="form-control p-1 @error('twiter') is-invalid @enderror" value="{{ old('twiter',optional($company)->twiter) }}" name="twiter" placeholder="Enter Twiter">
                                    </div>
                                    @error('twiter')
                                        <p class="text-end text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row mb-2">
                                    <!-- //Linkdin is replased by wechat  -->
                                    <div class="col-md-3 col-12">
                                        <label for="password">Linkdin :</label>
                                    </div>
                                    <div class="col-md-9 col-12">
                                          <input type="text" class="form-control p-1 @error('linkdin') is-invalid @enderror" name="linkdin" value="{{ old('linkdin',optional($company)->linkdin) }}" placeholder="Enter Linkdin Link">
                                    </div>
                                    @error('linkdin')
                                        <p class="text-end text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="phone">Address :</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Type Address" rows="2">{{ old('address',optional($company)->address) }}</textarea>
                                         @error('address')
                                            <p>{{ $message }}</p>
                                         @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="phone">Map :</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <textarea class="form-control @error('map_url') is-invalid @enderror" name="map_url" placeholder="Org. Location" rows="2">{{ old('map_url',optional($company)->map_url) }}</textarea>
                                         @error('map_url')
                                            <p>{{ $message }}</p>
                                         @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                   <div class="col-md-12 col-12 d-flex justify-content-center mt-1">
                                         <label for="imageInput" style="cursor: pointer;">
                                            <!-- (placeholder) -->
                                            <img id="previewImage" 
                                                src="{{ ($company && $company->logo) ? asset('storage/'.$company->logo) : asset('assets/admin/img/demoUpload.jpg')}}" 
                                                alt="Demo Image" 
                                                class="profileImg"
                                                style="">
                                        </label>
                                        <!-- hidden input -->
                                        <input type="file" name="logo" id="imageInput" name="image" accept="image/*" style="display: none;">
                                        @error('logo')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                           <input type="submit" value="Submit" class="btn btn-primary me-3 p-2">
                        </div>
                    </div>
                </form>
			</div>
        </div>
@endsection

@section('pageside')
  @include('admin.layout.sidebar',['page' => 'company'])
@endsection

@push('script')
    <script>
        const imageInput = document.getElementById('imageInput');
        const previewImage = document.getElementById('previewImage');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        })
    </script>
@endpush