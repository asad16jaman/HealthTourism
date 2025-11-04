@extends('admin.layout.app')

@section('title', 'Hospitals Page')

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
            width: 100px;
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
        .tablepicture2{
            width: auto;
            height: 30px;
            object-fit: fill;
        }
        .btn-sm {
            font-size: 11px;
            padding: 1px 6px;
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
                                                <option value="{{ $country->id }}" {{ ($country->id == old('country_id') || optional($editItem)->country_id == $country->id) ? 'selected' : "" }}>{{ $country->country }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3">
                                        <label for="title">Heading</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="title" id="title" value="{{ old('title',optional($editItem)->title) }}"
                                            class="form-control form-control-sm">
                                        @error('title')
                                            <p class="text-danger text-center">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-6">
                                         <p>Logo</p>
                                         <label for="imageInput" style="cursor: pointer;">
                                                <!-- (placeholder) -->
                                                <img id="previewImage" src="{{$editItem ? asset('storage/' . $editItem->img) : asset('assets/admin/img/demoUpload.jpg') }}"
                                                    alt="Demo Image" class="profileImg" style="">
                                            </label>
                                            <!-- hidden input -->
                                            <input type="file" name="img" id="imageInput" accept="image/*" style="display: none;">
                                            @error('img')
                                                <p class="text-danger text-center">{{ $message }}</p>
                                            @enderror
                                    </div>
                                    <div class="col-6">
                                        <p>Image</p>
                                         <label for="pictureInput" style="cursor: pointer;">
                                                <!-- (placeholder) -->
                                                <img id="picturePreview" src="{{($editItem && $editItem->picture) ? asset('storage/' . $editItem->picture) : asset('assets/admin/img/demoUpload.jpg') }}"
                                                    alt="Demo Image" class="profileImg" style="">
                                            </label>
                                            <!-- hidden input -->
                                            <input type="file" name="picture" id="pictureInput" accept="image/*" style="display: none;">
                                            @error('picture')
                                                <p class="text-danger text-center">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <label for="long_Description">Long Discription :</label>
                                    <textarea name="description" class="form-control" rows="6"
                                        id="summernote">{{ old('description',optional($editItem)->description) }}</textarea>
                                </div>
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
                                            <th style="width: 114.469px;">Logo</th>
                                            <th style="width: 114.469px;">Picture</th>
                                            <th style="width: 214.469px;">Country</th>
                                            <th style="width: 74.469px;">Detail</th>
                                            <th style="width: 81.375px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($allclient as $team)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $loop->iteration }}</td>
                                                <td>
                                                    <img class="tablepicture"
                                                        src="{{ $team->img ? asset('storage/' . $team->img) : asset('assets/admin/img/no-image.jpg') }}"
                                                        alt="user profile picture">
                                                </td>
                                                <td>
                                                    <img class="tablepicture2"
                                                        src="{{ $team->picture ? asset('storage/' . $team->picture) : asset('assets/admin/img/no-image.jpg') }}"
                                                        alt="user profile picture">
                                                </td>
                                                <td>
                                                    {{ $team->country->country }}
                                                </td>
                                                <td>
                                                   <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $team->id }}">View</button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="staticBackdrop{{ $team->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $team->title }}</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable px-3">
                                                            {!! $team->description !!}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>








                                                   
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('admin.client' ,['id'=>$team->id,'page'=>request()->query('page'),'search'=>request()->query('search')]) }}"
                                                                    class="btn btn-info p-1 me-1">
                                                                    <i class="fas fa-edit iconsize"></i>
                                                                </a>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
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

            const imageInput2 = document.getElementById('pictureInput');
            const previewImage2 = document.getElementById('picturePreview');
            imageInput2.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage2.src = e.target.result;
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

            $(document).ready(function () {
                $('#summernote').summernote({
                    height: 200,
                    disableDragAndDrop: true,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['fontsize', 'color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            });

        </script>

    @endpush