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

@section('pageside')
  @include('admin.layout.sidebar',['page' => 'profile'])
@endsection

@section('bodyContent')

    <div class="container">

        <div class="page-inner">

            <div class="card">
                <div class="card-header pt-1 pb-0">
                    <h4 class="text-center">Create User</h4>
                </div>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-3 ">
                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="email2">User Name :</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control p-1" {{ $editUser ? 'readonly' : '' }} name="username" value="{{ $editUser ? $editUser->username : "" }}"
                                            placeholder="Enter Username">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="email2">Full Name :</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control p-1"  name="fullname" value="{{ $editUser ? $editUser->fullname : "" }}"
                                            placeholder="Enter Full Name">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="email2">User Email</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="email" value="{{ $editUser ? $editUser->email : "" }}" name="email" class="form-control p-1" id="" placeholder="Enter Email">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <label for="type">User Type</label>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <select name="type" class="form-control p-1">
                                        @if($editUser)
                                        <option value="customer">Customer</option>
                                        <option @selected( $editUser->type == 'admin' ) value="admin" >Admin</option>

                                        @else
                                            <option value="customer">Customer</option>
                                            <option value="admin" >Admin</option>
                                        @endif
                                        <!-- <option value="staff">Staff</option>
                                        <option value="partner">Partner</option> -->
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <label for="password">Password :</label>
                                    </div>
                                    <div class="col-md-9 col-12">
                                          <input type="password" class="form-control p-1" name="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-12 d-flex justify-content-center mt-1">
                                         <label for="imageInput" style="cursor: pointer;">
                                            <!-- (placeholder) -->
                                            <img id="previewImage" 
                                                src="{{ ($editUser && $editUser->picture)  ? asset('storage/'.$editUser->picture) : asset('assets/admin/img/demoProfile.png') }}" 
                                                alt="Demo Image" 
                                                class="profileImg"
                                                style="">
                                        </label>

                                        <!-- hidden input -->
                                        <input type="file" name="picture" id="imageInput" name="image" accept="image/*" style="display: none;">
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