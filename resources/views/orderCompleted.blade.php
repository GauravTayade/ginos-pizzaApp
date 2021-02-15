@extends('layout.master')
@section('content')

<div class="jumbotron jumbotron-fluid background-green text-white custome-font">
    <div class="container text-center">
        <h1 class="display-4">Thank You for your Order</h1>
        <p class="lead">welcome to Gino's Pizza Store Ordering System</p>
        <h1 class="display-4">Order: # {{$orderNumber}}</h1>
        <h1 class="display-4">{{$customer['name']}}</h1>
        <h1 class="display-4">{{$customer['email']}}</h1>
        <h1 class="display-4">{{$customer['cell']}}</h1>
        <div class="col-md-12">
            <a href="/" class="btn btn-success">Take Me Home</a>
        </div>
    </div>
</div>

@endsection