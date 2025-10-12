@extends('admin.layout.app')

@section('title', 'Feedback Page')

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
            width: 150px;
            height: 100px;
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
            padding: 2px !important;
            margin-bottom: 2px;
        }
    </style>
@endsection
@section('pageside')
  @include('admin.layout.sidebar',['page' => 'feedback'])
@endsection
@section('bodyContent')
    <div class="container">
        <div class="page-inner">
            <div class="card mb-1">
                <div class="card-header pt-1 pb-0">
                    <h6 class="text-center">Create Feedback</h6>
                </div>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-2 ">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="title">User Name:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                       <input type="text" class="form-control p-1 @error('name') is-invalid
                                        @enderror" name="name"
                                            value="{{ $editfeedback ? $editfeedback->name : "" }}" placeholder="Enter Name">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="">Description :</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <textarea class="form-control @error('note') is-invalid
                                        @enderror" name="note" placeholder="" id="comment"
                                            rows="3">{{ old('note',optional($editfeedback)->note) }}</textarea>
                                        @error('note')
                                            <p class="text-danger">{{ $message }}</p>
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
                                                src="{{ $editfeedback ? asset('storage/' . $editfeedback->img) : asset('assets/admin/img/demoUpload.jpg') }}"
                                                alt="Demo Image" class="profileImg" style="">
                                        </label>

                                        <!-- hidden input -->
                                        <input type="file" name="img" id="imageInput" name="image" accept="image/*"
                                            style="display: none;">
                                        
                                    </div>
                                    <p class="text-danger text-center" style="font-size:12px;margin-bottom:0px;margin-top:5px">JPG/JPEG/PNG . Ratio:3/2</p>
                                    @error('img')
                                            <p class="text-danger text-center mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Submit" class="btn btn-primary me-3 p-1">
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <h6 class="card-title ">Feedback Items</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="basic-datatables_length">

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="basic-datatables_filter" class="dataTables_filter">
                                                <label class="d-flex justify-content-end">Search:
                                                    <form id="searchform">

                                                        <input type="search" value="{{ request()->query('search') }}"
                                                            name="search" class="form-control form-control-sm"
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
                                                    <tr role="row bg-dark">
                                                        <th style="width: 136.031px;" class="p-1">SL NO:</th>
                                                        <th style="width: 214.469px;" class="p-1">Image</th>
                                                        <th style="width: 214.469px;" class="p-1">Name</th>
                                                        <th style="width: 214.469px;" class="p-1">description</th>
                                                        <th style="width: 81.375px;" class="p-1">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @forelse($allfeedback as $item)
                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1">{{ $loop->iteration }}</td>
                                                            <td class="">
                                                                <img class="tablepicture"
                                                                    src="{{ asset('storage/' . $item->img) }}"
                                                                    alt="Image Not Found">
                                                            </td>
                                                            <td>{{ $item->name}}</td>
                                                            
                                                            <td>{{ substr($item->note, 0, 30) }}...</td>


                                                            <td class="d-flex justify-content-center">
                                                                <a href="{{ route('admin.feedback' ,['id'=>$item->id,'page'=>request()->query('page'),'search'=>request()->query('search')]) }}"
                                                                    class="btn btn-info p-1 me-1">
                                                                    <i class="fas fa-edit iconsize"></i>
                                                                </a>
                                                                <form
                                                                    action="{{ route('admin.feedback.delete', ['id' => $item->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <!-- <input type="submit" value="Delete"> -->
                                                                    <button type="submit" class="btn btn-danger p-1 deleteBtn"><i
                                                                            class="fas fa-trash-alt iconsize"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <p>there is no Feedback</p>

                                                    @endforelse



                                                </tbody>
                                            </table>
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