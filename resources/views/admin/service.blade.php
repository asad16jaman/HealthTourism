@extends('admin.layout.app')

@section('title', 'Service Page')

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
            width: 30px;
            height: 30px;
            object-fit: fill;
        }

        .headbg>tr>th {
            background-color: #3c5236;
            color: #fff;
            padding: 2px !important;
            margin-bottom: 2px;
        }

        .productimages {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .preview-img {
            position: relative;
            display: inline-block;
        }

        .preview-img img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .preview-img .remove-btn {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            cursor: pointer;
        }
    </style>
@endsection

@section('pageside')
    @include('admin.layout.sidebar', ['page' => 'service'])
@endsection

@section('bodyContent')
    <div class="container">
        <div class="page-inner">
            <div class="card mb-1">
                <div class="card-header pt-1 pb-0">
                    <h4 class="text-center">Create Service</h4>
                </div>
                <form method="post" id="productForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-3 ">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="">Name :</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control p-1 @error('name') is-invalid
                                        @enderror" name="name" value="{{ old('name', optional($editItem)->name)}}"
                                            placeholder="Enter Service Name">
                                        @error('name')
                                            <p class="text-danger">{{  $message }}</p>
                                        @enderror

                                    </div>
                                </div>


                            </div>

                            <div class="col-md-6 col-12">
                                <div class="row">
                                    <div class="col-md-12 col-12 d-flex justify-content-center mt-1">
                                        <label for="imageInput" style="cursor: pointer;">
                                            <!-- (placeholder) -->
                                            <img id="previewImage"
                                                src="{{ ($editItem && $editItem->img) ? asset('storage/' . $editItem->img) : asset('assets/admin/img/demoUpload.jpg') }}"
                                                alt="Demo Image" class="profileImg" style="">
                                        </label>

                                        <!-- hidden input -->
                                        <input type="file" name="img" id="imageInput" accept="image/*"
                                            style="display: none;">
                                    </div>
                                    @error('img')
                                        <p class="text-danger text-center">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <label for="description">Discription :</label>
                                    <textarea name="description" class="form-control" rows="6"
                                        id="description">{{ old('description', optional($editItem)->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <input type="submit" value="Submit" class="btn btn-primary me-3 p-2">
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Service</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead class="headbg">
                                        <tr role="row bg-dark">
                                            <th style="width: 136.031px;">SL NO:</th>
                                            <th style="width: 35.875px;">Image</th>
                                            <th style="width: 214.469px;">Name</th>
                                            <th style="width: 214.469px;">Title</th>
                                            <th style="width: 514.469px;">Description</th>
                                            <th style="width: 81.375px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($datas as $data)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ route('admin.service.message', ['id' => $data->id]) }}"
                                                        title="Click to see Message About This Service">
                                                        <img class="tablepicture"
                                                            src="{{ $data->img ? asset('storage/' . $data->img) : asset('assets/admin/img/demoProfile.png') }}"
                                                            alt="user profile picture">
                                                    </a>
                                                </td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->title}}</td>
                                                <td>{{ substr(strip_tags($data->description), 0, 100) }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('admin.service', ['id' => $data->id, 'page' => request()->query('page'), 'search' => request()->query('search')]) }}"
                                                        class="btn btn-info p-1 me-1">
                                                        <i class="fas fa-edit iconsize"></i>
                                                    </a>
                                                    <form action="{{ route('admin.service.delete', ['id' => $data->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <!-- <input type="submit" value="Delete"> -->
                                                        <button type="submit" class="btn btn-danger p-1 deleteBtn"><i
                                                                class="fas fa-trash-alt iconsize"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>there is no Service</p>
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
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
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
            ClassicEditor
                .create(document.querySelector('#description'), {
                })
                .catch(error => {
                    console.error('CKEditor Error:', error);
                });

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