@extends('admin.layout.app')

@section('title', 'Admin Page')

@section('style')
    <style>
        .table>tbody>tr>td {
            padding: 0px !important;
            margin-bottom: 2px;
        }

        .iconsize {
            font-size: 15px;
        }

        .profileImg {
            width: auto;
            height: 100px;
            object-fit: cover;
            border: 2px dashed #ccc;
            border-radius: 6px;
        }

        .tablepicture {
            width: 100px;
            height: 30px;
            object-fit: fill;
        }

        .headbg>tr>th {
            background-color: #3c5236;
            color: #fff;
            padding: 2px !important;
            margin-bottom: 2px;
        }
    </style>
@endsection

@section('pageside')
    @include('admin.layout.sidebar', ['page' => 'hospital'])
@endsection

@section('bodyContent')
    <div class="container">
        <div class="page-inner">
            <div class="card">
                <div class="card-header pt-1 pb-0">
                    <h4 class="text-center">Create Hospital</h4>
                </div>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-3 ">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Country</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="country_id" id="" class="form-select">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ $country->id == old('country_id') ? 'selected' : "" }}>{{ $country->country }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 d-flex justify-content-center">
                                <label for="imageInput" style="cursor: pointer;">
                                    <!-- (placeholder) -->
                                    <img id="previewImage" src="{{asset('assets/admin/img/demoUpload.jpg') }}"
                                        alt="Demo Image" class="profileImg" style="">
                                </label>
                                <!-- hidden input -->
                                <input type="file" name="img" id="imageInput" accept="image/*" style="display: none;">
                                @error('img')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-primary me-3 p-2">
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Hospital</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead class="headbg">
                                        <tr role="row bg-dark">
                                            <th style="width: 136.031px;">SL NO:</th>
                                            <th style="width: 214.469px;">Picture</th>
                                            <th style="width: 214.469px;">Country</th>
                                            <th style="width: 81.375px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($allclient as $team)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $loop->iteration }}</td>
                                                <td>
                                                    <img class="tablepicture"
                                                        src="{{ $team->img ? asset('storage/' . $team->img) : asset('assets/admin/img/demoProfile.png') }}"
                                                        alt="user profile picture">
                                                </td>
                                                <td>
                                                    {{ $team->country->country }}
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <form action="{{ route('admin.client.delete', ['id' => $team->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <!-- <input type="submit" value="Delete"> -->
                                                        <button type="button" class="btn btn-danger p-1 deleteBtn"><i
                                                                class="fas fa-trash-alt iconsize"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>there is no Hospital</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
    @push('script')
        <!-- Datatables -->
        <script src="{{ asset('assets/admin/js/plugin/datatables/datatables.min.js') }}"></script>
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

            $(document).ready(function () {
                $("#basic-datatables").DataTable({
                    sort: false
                });
            })

        </script>

    @endpush