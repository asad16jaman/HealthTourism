<!-- service-message -->
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
    @include('admin.layout.sidebar', ['page' => 'report'])
@endsection

@section('bodyContent')
    <div class="container">
        <div class="page-inner" style="min-height: 80vh;">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead class="headbg">
                                        <tr role="row bg-dark">
                                            <th style="width: 136.031px;">SL NO:</th>
                                            <th style="width: 400.875px;">Name</th>
                                            <th style="width: 214.469px;">Email</th>
                                            <th style="width: 150.469px;">City</th>
                                            <th style="width: 150.469px;">Address</th>
                                            <th style="width: 70.469px;">Detail</th>
                                            <th style="width: 200.469px;">Date</th>
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
                                                <td>{{ $data->city}}</td>
                                                <td>{{ $data->address}}</td>
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

                                                                    <h5>Message</h5>
                                                                    <hr>
                                                                    {!! $data->message !!}
                                                                    <hr>
                                                                    <a href="{{ route('admin.report.download', ['id' => $data->id]) }}"
                                                                        class="btn btn-primary">Download Report</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $data->created_at->format('d M Y, g:ia') }}</td>
                                                <td class="d-flex justify-content-center">

                                                    <form action="{{ route('admin.report.delete', ['id' => $data->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <!-- <input type="submit" value="Delete"> -->
                                                        <button type="submit" class="btn btn-danger p-1 deleteBtn"><i
                                                                class="fas fa-trash-alt iconsize"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>there is no Message</p>
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