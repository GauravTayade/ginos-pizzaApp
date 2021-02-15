@extends('layout.master')
@section('content')

<div class="jumbotron jumbotron-fluid background-green text-white">
    <div class="container text-center">
        <h1 class="display-4">Select The Best Of Wings</h1>
        <p class="lead">welcome to Gino's Pizza Store Ordering System</p>
    </div>
</div>
<div class="col-md-12 text-center">
    <a href="{{URL::asset('/getDashboard') }}" class="btn btn-success col-md-2 m-3">Go to Dashbaord</a>
    <a href="{{URL::asset('/checkout') }}" class="btn btn-warning col-md-2 m-3">Checkout</a>
</div>
<div class="col-md-12 justify-content-center">
    <div class="row d-flex justify-content-center">
    @foreach ($wings as $wing)
            <div class="card text-white bg-secondary m-2 background-yellow custome-font" style="width:15rem;">
                <img src="{{URL::asset($wing->wingImage) }}" class="card-img-top" alt="...">
                <div class="card-body product-desc">
                    <h5 class="card-title">{{$wing->wingName}}</h5>
                    <p class="card-text">{{$wing->wingDesc}}</p>
                    <div class="row mx-auto mb-2">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="{{$wing->wingId.'_rdoSauce'}}" id="rdoSide" value="side" checked>
                            <label class="form-check-label" for="rdoSide">
                              On Side
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{$wing->wingId.'_rdoSauce'}}" id="rdoMix" value="mix">
                            <label class="form-check-label" for="rdoMix">
                              Mix
                            </label>
                        </div>
                    </div>
                    <p> 
                        @php
                            $options = json_decode($wing->options);
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
                    <p class="card-text custome-font price-tag">$ {{Round($wing->wingPrice,2)}}</p>
                    <div class="col-md-12 text-center">
                        <input type="button" data-id="{{$wing->wingId}}" data-productname="{{$wing->wingName}}" value="Add" class="btn btn-primary" id="btnAddWing">
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