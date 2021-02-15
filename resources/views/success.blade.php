@extends('layout.master')
@section('content')


    <div class="jumbotron jumbotron-fluid background-green text-white">
        <div class="container text-center">
            <h1 class="display-4">Success</h1>
            <p class="lead">Your item has been added to Order</p>
        </div>
    </div>
    <div class="row h-100 d-flex justify-content-center">
        <a class="btn btn-success mx-auto col-md-4 text-center m-3" href="{{url('getDashboard')}}">Add More Items</a>
        <a class="btn btn-success mx-auto col-md-4 text-center m-3" href="{{url('checkout')}}">Checkout</a>
    </div>

@endsection