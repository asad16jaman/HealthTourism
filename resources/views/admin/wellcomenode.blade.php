@extends('admin.layout.app')

@section('title', 'Welcome Page')

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
    @include('admin.layout.sidebar', ['page' => 'wellcome'])
@endsection

@section('bodyContent')
    <div class="container">
        <div class="page-inner">
            <div class="card mb-1">
                <div class="card-header pt-1 pb-0">
                    <h4 class="text-center">Create Welcome Note</h4>
                </div>
                <form method="post" id="productForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-3 ">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="title">Title :</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="text" id="title" class="form-control p-1 @error('title') is-invalid
                                        @enderror" name="title" value="{{ old('title',optional($editItem)->title)}}"
                                            placeholder="Enter Product Name">
                                        @error('title')
                                            <p class="text-danger">{{  $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 col-12">
                                
                                <div class="row">
                                    <div class="col-12">
                                            <div class="w-100 d-flex justify-content-center mt-1">
                                            <label for="imageInput" style="cursor: pointer;">
                                            <!-- (placeholder) -->
                                            <img id="previewImage"
                                                src="{{ ($editItem && $editItem->image_1) ? asset('storage/' . $editItem->image_1) : asset('assets/admin/img/demoUpload.jpg') }}"
                                                alt="Demo Image" class="profileImg" style="">
                                        </label>
                                        <!-- hidden input -->
                                        <input type="file" name="image_1" id="imageInput" accept="image/*"
                                            style="display: none;">
                                        </div>
                                        @error('image_1')
                                            <p class="text-danger text-center">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    
                                    <p class="text-danger text-center" style="font-size:12px">JPG/JPEG/PNG</p>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <label for="description">Discription :</label>
                                    <textarea name="note" class="form-control" rows="6"
                                        id="description">{{ old('note', optional($editItem)->note) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <input type="submit" value="Submit" class="btn btn-primary me-3 p-2">
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
</div>
@endsection

    @push('script')
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
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

            const imageInput2 = document.getElementById('imageInput2');
            const previewImage2 = document.getElementById('previewImage2');
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

        </script>

    @endpush