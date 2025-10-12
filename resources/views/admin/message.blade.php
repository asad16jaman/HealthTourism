@extends('admin.layout.app')

@section('title', 'Contact Message Page')

@section('pageside')
    @include('admin.layout.sidebar', ['page' => 'contact'])
@endsection

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
    </style>
@endsection

@section('bodyContent')

    <div class="container">
        <div class="page-inner" style="padding:0px 10px!important">
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($message as $msg)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $loop->iteration }}</td>
                                                <td>{{ $msg->name }}</td>
                                                <td>{{ $msg->email }}</td>
                                                <td>{{ $msg->subject }}</td>
                                                <td>{{ $msg->message }} </td>
                                                <td>{{ $msg->created_at->format('d-m-Y h:ia') }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <form action="{{ route('admin.message.delete', ['id' => $msg->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <!-- <input type="submit" value="Delete"> -->
                                                        <button type="button" class="btn btn-danger p-1 deleteBtn"><i
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