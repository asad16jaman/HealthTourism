@extends('admin.layout.app')

@section('title', 'Admin Page')

@section('style')
   
@endsection

@section('pageside')
  @include('admin.layout.sidebar',['page' => 'error'])
@endsection

@section('bodyContent')

    <div class="container">
        <div class="row mt-5">
            <div class="col-12 mt-5">
                <p class="text-center">There is problame. please try again later And contact with developer</p>
                <h1 class="text-danger text-center">404</h1>
            </div>
        </div>
    </div>

@endsection

   