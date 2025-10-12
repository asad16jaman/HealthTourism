@extends('admin.layout.app')

@section('title', 'Admin Page')

@section('style')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        .table>tbody>tr>td {
            padding: 0px !important;
            margin-bottom: 2px;
        }

        .iconsize {
            font-size: 15px;
        }

        .profileImg {
            width: 150px;
            height: 70px;
            object-fit: contain;
            /* border: 2px dashed #ccc; */
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
        }
        
    </style>
@endsection

@section('pageside')
  @include('admin.layout.sidebar',['page' => 'ch'])
@endsection

@section('bodyContent')

    <div class="container">

        <div class="page-inner">

            <div class="card">
                <div class="card-header pt-1 pb-0">
                    <h4 class="text-center">Create Chairman Message</h4>
                </div>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-3 ">
                        <div class="row">
                            <div class="col-md-8 col-12">
                                <div class="row mb-2">
                                    <div class="col-md-12 col-12">
                                        <label for="email2">Name :</label>
                                        <input type="text" class="form-control p-1 @error('name') is-invalid
                                        @enderror" name="name" value="{{  old('name',optional($ch)->name) }}"
                                            placeholder="Enter Name">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="col-md-12 col-12 d-flex justify-content-center mt-1">
                                    <label for="imageInput" style="cursor: pointer;">
                                        <!-- (placeholder) -->
                                        <img id="previewImage" src="{{ ($ch && $ch->img) ? asset('storage/'.$ch->img )  : asset('assets/admin/img/demoUpload.jpg') }}"
                                            alt="Demo Image" class="profileImg" style="">
                                    </label>
                                    <!-- hidden input -->
                                    <input type="file" name="img" id="imageInput" accept="image/*" style="display: none;">
                                </div>
                                <p class="text-danger text-center" style="font-size:12px;margin-bottom:0px;margin-top:3px">JPG/JPEG/PNG . Ratio:1/1</p>
                            </div>
                        </div>
                        <div class="row mb-2 mt-2 ms-2"> 
                            <label for="long_Description">Speech :</label>
                            <textarea name="speech" class="form-control  $error('speech') is-invalid $enderror"  id="description">{{ old('speech',optional($ch)->speech) }}</textarea>      
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
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    
        <script>
                ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                        console.error('CKEditor Error:', error);
                });
            //for text editor end
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