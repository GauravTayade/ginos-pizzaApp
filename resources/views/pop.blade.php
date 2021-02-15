@extends('layout.master')
@section('content')

<div class="jumbotron jumbotron-fluid background-green text-white m-0">
    <div class="container text-center">
        <h1 class="display-4">Get Pops to Make It Fun</h1>
        <p class="lead">welcome to Gino's Pizza Store Ordering System</p>
    </div>
</div>
<div class="col-md-12">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <a href="{{URL::asset('/getDashboard') }}" class="btn btn-success col-md-5 m-3">Go to Dashbaord</a>
            <a href="{{URL::asset('/checkout') }}" class="btn btn-warning col-md-5 m-3">Checkout</a>
        </div>
    </div>
</div>
<div class="col-md-12 justify-content-center">
    <div class="row d-flex justify-content-center">
    @foreach ($pops as $pop)
            <div class="card text-white bg-secondary m-2 background-yellow custome-font" style="width:15rem;">
                <img src="{{URL::asset($pop->image) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$pop->popName}}</h5>
                </div>
                <div class="p-3">
                    <p class="card-text text-white custome-font price-tag">$ {{number_format($pop->popPrice,2,'.','')}}</p>
                    <div class="col-md-12 text-center">
                        <input type="button" data-id="{{$pop->popId}}" data-productname="{{$pop->popName}}" value="Add" class="btn btn-primary" id="btnAddPop">
                    </div>
                </div>
            </div>
    @endforeach
    </div>
</div>
@endsection
@section('js')
    <script src="{{URL::asset('js/products.js')}}" type="text/javascript"></script>
@endsection