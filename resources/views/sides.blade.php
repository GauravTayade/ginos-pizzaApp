@extends('layout.master')
@section('content')

<div class="jumbotron jumbotron-fluid background-green text-white">
    <div class="container text-center">
        <h1 class="display-4">Select The Best Of Side Dishes</h1>
        <p class="lead">welcome to Gino's Pizza Store Ordering System</p>
    </div>
</div>
<div class="col-md-12 text-center">
    <a href="{{URL::asset('/getDashboard') }}" class="btn btn-success col-md-2 m-3">Go to Dashbaord</a>
    <a href="{{URL::asset('/checkout') }}" class="btn btn-warning col-md-2 m-3">Checkout</a>
</div>
<div class="col-md-12 justify-content-center">
    <div class="row d-flex justify-content-center">
    @foreach ($sides as $side)
    <div class="card text-white bg-secondary m-4 background-yellow custome-font" style="width:15rem;">
        <img src="{{URL::asset($side->sideImage) }}" class="card-img-top img-fluid" alt="...">
        <div class="card-body product-desc">
            <h5 class="card-title">{{$side->sideName}}</h5>
            <p class="card-text">{{$side->sideDesc}}</p>
            <p> 
                        @php
                            $options = json_decode($side->options);
                        @endphp
                        @if(!is_null($options))
                        <select class="custom-select" name="option" id="select">
                                <option value="0">Select Option</option>
                            @foreach ($options as $optionkey => $optionValue)
                                <option value="{{$optionkey}}" data-value="{{ $optionValue }}">{{ $optionkey }}</option>
                            @endforeach
                        </select>
                        @endif
            </p>
        </div>
        <div class="p-3">
            <p class="card-text price-tag">$ {{Round($side->sidePrice,2)}}</p>
            <div class="col-md-12 text-center">
                <input type="button" data-id="{{$side->sideId}}" data-productname="{{$side->sideName}}" value="Add" class="btn btn-primary" id="btnAddSide">
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