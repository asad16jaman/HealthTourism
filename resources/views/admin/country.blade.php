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

        .headbg>tr>th {
            background-color: #3c5236;
            color: #fff;
            padding: 2px !important;
            margin-bottom: 2px;
        }
    </style>
@endsection

@section('pageside')
    @include('admin.layout.sidebar', ['page' => 'country'])
@endsection



@section('bodyContent')
    <div class="container">
        <div class="page-inner">
            
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card mb-1">
                <div class="card-header pt-1 pb-0">
                    <h4 class="text-center">Create Country</h4>
                </div>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-3 ">
                        <div class="row">
                            
                            <label class="col-md-4 col-12" for="email2">Country Name :</label>
                                
                            <div class="col-md-8 col-12">
                                <input type="text" class="form-control p-1 @error('country') is-invalid
                                @enderror" name="country" value="{{ old('country')  }}"
                                    placeholder="Enter Country Name">
                                @error('country')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-1">
                        <input type="submit" value="Submit" class="btn btn-primary me-3 p-1">
                    </div>
                </form>
            </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <h5 class="card-title ">All Country</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 offset-md-6 col-md-6">
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="basic-datatables"
                                                class="display table table-striped table-hover dataTable" role="grid"
                                                aria-describedby="basic-datatables_info">
                                                <thead class="headbg">
                                                    <tr role="row bg-dark">
                                                        <th style="width: 136.031px;">SL NO:</th>
                                                        <th style="width: 214.469px;">Name</th>
                                                        <th style="width: 81.375px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($countries as $country)
                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1">{{ $loop->iteration }}</td>

                                                            <td>{{ $country->country }}</td>

                                                            <td class="d-flex justify-content-center">
                                                                @if($country->id == 9)
                                                                    Default
                                                                @else
                                                                    <form
                                                                    action="{{ route('admin.country.delete', ['id' => $country->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <!-- <input type="submit" value="Delete"> -->
                                                                    <button type="submit" class="btn btn-danger p-1 deleteBtn"><i
                                                                            class="fas fa-trash-alt iconsize"></i></button>
                                                                </form>
                                                                @endif
                                                                
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <p>there is no Country</p>

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
    </div>
@endsection

@push('script')
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
    </script>

@endpush