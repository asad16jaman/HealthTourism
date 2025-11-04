<!-- service-message -->
@extends('admin.layout.app')



@section('title', 'Booking Page')

@section('style')

<link rel="stylesheet" href="{{ asset('assets/admin/css/lightbox.css') }}" />
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
    @include('admin.layout.sidebar', ['page' => 'booking'])
@endsection

@section('bodyContent')
    <div class="container">
        <div class="page-inner" style="min-height:80vh">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Booking Message</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead class="headbg">
                                        <tr role="row bg-dark">
                                            <th style="width: 136.031px;">SL NO:</th>
                                            <th style="width: 300.875px;">Name</th>
                                            <th style="width: 214.469px;">Email</th>
                                            <th style="width: 150.469px;">Phone</th>
                                            <th style="width: 170.875px;">Companion</th>
                                            <th style="width: 150.469px;">Status</th>
                                            <th style="width: 70.469px;">Message</th>
                                            <th style="width: 330.469px;">Date</th>
                                            <th style="width: 81.375px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($datas as $data)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $data->name }}
                                                </td>
                                                <td>{{ $data->email }}</td>
                                                <td>{{ $data->phone}}</td>
                                                <td>

                                                    <button type="button" class="btn btn-primary p-1" data-bs-toggle="modal"
                                                        data-bs-target="#viewCompany{{ $data->id }}">
                                                        View
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="viewCompany{{ $data->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                        Companion Persons</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-striped">
                                                                        <thead class="headbg">
                                                                            <tr>
                                                                                <th>SL No</th>
                                                                                <th>Name</th>
                                                                                <th>Type</th>
                                                                                <th>Passport No</th>
                                                                                <th>Expire date</th>
                                                                            </tr>

                                                                        </thead>
                                                                        <tbody>
                                                                            @forelse ($data->relations as $relation)
                                                                                <tr>
                                                                                    <td>{{ $loop->iteration }}</td>
                                                                                    <td>{{ $relation->name }}</td>
                                                                                    <td>{{ $relation->type }}</td>
                                                                                    <td>{{ $relation->passport }}</td>
                                                                                    <td>{{ $relation->exp_date }}</td>
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td colspan="5" class="text-center">
                                                                                        <p class="mb-0">No Companion Person Found</p>
                                                                                    </td>
                                                                                    
                                                                                </tr>
                                                                            @endforelse
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.apoint.changeStatus',['id'=>$data->id]) }}" method="post">
                                                        @csrf 
                                                        <select name="status" id="changeStatus" class="form-select form-control-sm" onchange="this.form.submit()">
                                                            <option value="panding" >Pending</option>
                                                            <option value="progress" {{ $data->status == 'progress' ? "selected" : "" }}>In Progress</option>
                                                            <option value="complete" {{ $data->status == "complete" ?  "selected" : '' }}>complete</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary p-1" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop{{ $data->id }}">
                                                        View
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="staticBackdrop{{ $data->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                        {{ $data->name }}</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div>
                                                                        <p>Country: {{ $data->country->country }}</p>
                                                                        <p>Service Names: {{ $data->service_name }} </p>
                                                                        <p>Passport: {{ $data->passport ?? "Not Found" }}</p>
                                                                        <p>Expire Date: {{ $data->exp_date ?? "Not Found" }}</p>
                                                                        <p>Address: {{ $data->address }}</p>
                                                                        <p class="d-none">Status: {{ $data->status }}</p>
                                                                    </div>
                                                                    <h6>Message</h6>
                                                                    <hr>
                                                                    {!! $data->message !!}
                                                                    <hr>
                                                                        
                                                                           
                                                                            <div class="row">
                                                                              
                                                                                <div class="col-4 position-relative" style="height:105px" >
                                                                                    @if($data->passport_img)
                                                                                        <a href="{{ route('admin.fileDownload',['id' => $data->id,'name' => 'passport_image']) }}" class="btn btn-primary btn-sm position-absolute">
                                                                                        <i class="fas fa-download iconsize"></i>
                                                                                        </a>
                                                                                        <a href="{{ asset('storage').'/'.$data->passport_img }}" data-lightbox="roadtrip{{ $data->id }}">
                                                                                            <img style="width:100%;height:100%;object-fit:contain" src="{{ asset('storage').'/'.$data->passport_img }}" alt="{{ $data->name }}">
                                                                                        </a>
                                                                                    @else
                                                                                        <p class="text-center">Passport Not Found</p>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-4 position-relative" style="height:105px">
                                                                                    @if($data->prescription)
                                                                                        <a href="{{ route('admin.fileDownload',['id' => $data->id,'name' => 'prescription']) }}" class="btn btn-primary btn-sm position-absolute">
                                                                                        <i class="fas fa-download iconsize"></i>
                                                                                        </a>
                                                                                        <a href="{{ asset('storage').'/'.$data->prescription }}" data-lightbox="roadtrip{{ $data->id }}">
                                                                                            <img style="width:100%;height:100%;object-fit:contain" src="{{ asset('storage').'/'.$data->prescription }}" alt="{{ $data->name }}">
                                                                                        </a>
                                                                                    @else
                                                                                        <p class="text-center">Prescription Not Found</p>
                                                                                    @endif

                                                                                    
                                                                                </div>

                                                                                <div class="col-4 position-relative" style="height:105px">
                                                                                    @if($data->report)
                                                                                        <a href="{{ route('admin.fileDownload',['id' => $data->id,'name' => 'report']) }}" class="btn btn-primary btn-sm position-absolute">
                                                                                        <i class="fas fa-download iconsize"></i>
                                                                                        </a>
                                                                                        <a href="{{ asset('storage').'/'.$data->report }}" data-lightbox="roadtrip{{ $data->id }}">
                                                                                            <img style="width:100%;height:100%;object-fit:contain" src="{{ asset('storage').'/'.$data->report }}" alt="{{ $data->name }}">
                                                                                        </a>
                                                                                    @else
                                                                                        <p class="text-center">Report Not Found</p>
                                                                                    @endif
                                                                                </div>
                                                                                    
                                                                               
                                                                            </div>
                                                                            
                                                                        
                                                                    <hr>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $data->created_at->format('d M Y, g:ia') }}</td>
                                                <td class="d-flex justify-content-center">

                                                    <form
                                                        action="{{ route('admin.apoint.delete', ['id' => $data->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <!-- <input type="submit" value="Delete"> -->
                                                        <button type="submit" class="btn btn-danger p-1 deleteBtn"><i
                                                                class="fas fa-trash-alt iconsize"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>there is no Apointment</p>
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
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        
        <script src="{{ asset('assets/admin/js/lightbox.js') }}"></script>
        <script>

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