@extends('layout.master')
@section('content')
    <div class="jumbotron jumbotron-fluid background-green text-white m-0">
        <div class="container text-center">
            <h1 class="display-4">Place Your Order</h1>
            <p class="lead">welcome to Gino's Pizza Store Ordering System</p>
        </div>
    </div>
    <div class="container-fluid mt-2 mb-5">
    <div class="d-flex justify-content-around row">
        <a href="{{url('special')}}" class="dashboard-menu-item">
        <div class="card mx-1 mt-5 background-red" style="width:14rem">
            <img src="{{URL::asset('images/special.png')}}" class="mx-auto my-4 menu-image" alt="">
            <div class="card-body">
                <p class="card-text">
                    <h2 class="text-center text-white">Special</h2>
                </p>
            </div>
        </div>
        </a>
        <a href="{{url('pizza')}}" class="dashboard-menu-item">
        <div class="card mx-1 mt-5 background-red" style="width:14rem">
            <img src="{{URL::asset('images/pizza.png')}}" class="menu-image my-4 mx-auto" alt="">
            <div class="card-body">
                <p class="card-text">
                    <h2 class="text-center text-white">Pizza</h2>
                </p>
            </div>
        </div>
        </a>
        <a href="{{url('breads')}}" class="dashboard-menu-item">
        <div class="card mx-1 mt-5 background-red" style="width:14rem">
            <img src="{{URL::asset('images/bread.png')}}" class="mx-auto my-4 menu-image" alt="">
            <div class="card-body">
                <p class="card-text">
                    <h2 class="text-center text-white">Breads</h2>
                </p>
            </div>
        </div>
        </a>
        <a href="{{url('wings')}}" class="dashboard-menu-item">
        <div class="card mx-1 mt-5 background-red" style="width:14rem">
            <img src="{{URL::asset('images/wings.png')}}" class="mx-auto my-4 menu-image" alt="">
            <div class="card-body">
                <p class="card-text">
                    <h2 class="text-center text-white">wings</h2>
                </p>
            </div>
        </div>
        </a>
        <a href="{{url('pops')}}" class="dashboard-menu-item">
        <div class="card mx-1 mt-5 background-red" style="width:14rem">
            <img src="{{URL::asset('images/pop.png')}}" class="mx-auto my-4 menu-image" alt="">
            <div class="card-body">
                <p class="card-text">
                    <h2 class="text-center text-white">Pops</h2>
                </p>
            </div>
        </div>
        </a>
        <a href="{{url('salad')}}" class="dashboard-menu-item">
        <div class="card mx-1 mt-5 background-red" style="width:14rem">
            <img src="{{URL::asset('images/salad.png')}}" class="mx-auto my-4 menu-image" alt="">
            <div class="card-body">
                <p class="card-text">
                    <h2 class="text-center text-white">Side</h2>
                </p>
            </div>
        </div>
        </a>
    </div>
    </div>
@endsection