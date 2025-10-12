@extends('admin.layout.app')

@section('title', 'Admin Page')

@section('style')
<style>
    .table > tbody > tr > td{
        padding: 0px !important;
        margin-bottom: 2px;
    }
    .iconsize{
        font-size: 15px;
    }
    .profileImg{
        width: auto;
        height: 100px; 
        object-fit: cover;
        border: 2px dashed #ccc;
        border-radius: 6px;
    }
    .tablepicture{
        width: 30px;
        height: 30px;
        object-fit: fill;
    }
    .headbg > tr > th{
        background-color: #3c5236;
        color: #fff;
        padding: 2px !important;
        margin-bottom: 2px;
    }
</style>
@endsection

@section('pageside')
  @include('admin.layout.sidebar',['page' => 'users'])
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
                                        <input type="text" class="form-control p-1 @error('username') is-invalid
                                        @enderror" {{ $editUser ? 'readonly' : '' }} name="username" value="{{  old('username',optional($editUser)->username)}}"
                                            placeholder="Enter Username">
                                        @error('username')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="email2">Full Name :</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control p-1"  name="fullname" value="{{ old('fullname',optional($editUser)->fullname ) }}"
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
                                        <input type="email" value="{{ old('email',optional($editUser)->email) }}" name="email" class="form-control p-1 @error('email') is-invalid
                                        @enderror" id="" placeholder="Enter Email">
                                       @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <label for="type">User Type</label>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <select name="type" class="form-control p-1">
                                        @if($editUser)
                                        <option value="customer">User</option>
                                        <option @selected( $editUser->type == 'admin' ) value="admin" >Admin</option>
                                        @else
                                            <option value="user">User</option>
                                            <option value="admin" >Admin</option>
                                        @endif
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <h5 class="card-title ">ALL Users</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        
                                        <div class="col-sm-12 col-md-6 offset-md-6">
                                            <div id="basic-datatables_filter" class="dataTables_filter">
                                                <label class="d-flex justify-content-end">Search:
                                                    <form>
                                                       
                                                        <input type="search" value="{{ request()->query('search') }}" name="search" class="form-control form-control-sm"
                                                            placeholder="" aria-controls="basic-datatables">
                                                    </form>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="basic-datatables"
                                                class="display table table-striped table-hover dataTable" role="grid"
                                                aria-describedby="basic-datatables_info">
                                                <thead class="headbg">
                                                    <tr role="row bg-dark" >
                                                        <th style="width: 136.031px;">SL NO:</th>
                                                        <th style="width: 214.469px;">Picture</th>
                                                        <th style="width: 214.469px;">User Name</th>
                                                        <th style="width: 214.469px;">Full Name</th>
                                                        <th style="width: 101.219px;">Email</th>
                                                        <th style="width: 35.875px;">Type</th>
                                                        <th style="width: 81.375px;">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                @forelse($allUsers as $user)
                                                    <tr role="row" class="odd" >
                                                        <td class="sorting_1">{{ $loop->iteration }}</td>
                                                        <td>
                                                        @if($user->picture)
                                                            <img class="tablepicture" src="{{ asset('storage/'.$user->picture) }}" alt="user profile picture">
                                                        @else
                                                            <img class="tablepicture" src="{{ asset('assets/admin/img/demoProfile.png') }}" alt="user profile picture">
                                                        @endif
                                                        </td>
                                                        <td>{{ $user->username }}</td>
                                                        <td>{{ $user->fullname ?? "None" }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->type }}</td>
                                                        <td class="d-flex justify-content-center">
                                                            
                                                            <a href="{{ route('admin.users',['id' => $user->id,'page'=>request()->query('page'),'search'=>request()->query('search')]) }}" class="btn btn-info p-1 me-1">
                                                                <i class="fas fa-edit iconsize"></i>
                                                            </a>

                                                            {{-- 
                                                                <form action="{{ route('admin.user.delete',['id'=>$user->id]) }}" method="post">
                                                                    @csrf
                                                                    <!-- <input type="submit" value="Delete"> -->
                                                                    <button type="button" class="btn btn-danger p-1 deleteBtn"><i class="fas fa-trash-alt iconsize"></i></button>
                                                                </form>
                                                            --}}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <p>there is no users</p>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end me-2">
                                            @if ($allUsers->previousPageUrl())
                                                <a href="{{ $allUsers->previousPageUrl() }}"
                                                    class="btn btn-primary mx-2 p-1"><i class="fas fa-hand-point-left"></i></a>
                                            @endif

                                            @if ($allUsers->nextPageUrl())
                                                <a href="{{ $allUsers->nextPageUrl() }}" class="btn btn-primary mx-2 p-1"><i
                                                        class="fas fa-hand-point-right "></i></a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


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

     $(document).on("click", ".deleteBtn", function (e) {
                e.preventDefault();
                let form = $(this).closest("form"); // nearest form select korbe

                swal({
                    title: "Are you sure?",
                    text: "You Want To Delete",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Cancel",
                            visible: true,
                            className: "btn btn-danger"
                        },
                        confirm: {
                            text: "Yes, delete it!",
                            className: "btn btn-success"
                        }
                    },
                    dangerMode: true,
                }).then((willDelete) => {
                    console.log(willDelete)
                    if (willDelete) {
                        form.submit(); // confirm hole form submit hobe
                    }
                });
            });
</script>

@endpush