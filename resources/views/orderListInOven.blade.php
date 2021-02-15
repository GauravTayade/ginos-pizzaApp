@extends('layout.master')
@section('content')

<div class="jumbotron jumbotron-fluid background-green text-white">
    <div class="container text-center">
        <h1 class="display-4">In Oven Orders</h1>
        <p class="lead">welcome to Gino's Pizza Store Ordering System</p>
    </div>
</div>
<div class="col-md-12 text-center">
    <a href="{{URL::asset('/ordersListInOven') }}" class="btn btn-success col-md-2">Refresh</a>
</div>
<div class="col-md-12 justify-content-center">
    <div class="row d-flex justify-content-center">
        @foreach ($ordersDeatilsList as $orderDetails)
            <div class="card text-white background-red m-3 col-md-5 ">
                <div class="card-header">
                    <div class="row justify-content-center m-2">
                        <a href="/completedOrder/{{$orderDetails['orderId']}}" class="btn btn-success col-md-4">Order Completed</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <i class="fas fa-shopping-cart mr-4"></i>Order: #{{$orderDetails['orderNumber']}}
                        </div>
                        <div class="col-md-6">
                            <i class="fas fa-user mr-4"></i>{{$orderDetails['name']}}
                        </div>
                        <div class="col-md-6">
                            <i class="fas fa-phone-alt mr-4"></i>{{$orderDetails['phone']}}
                        </div>
                        <div class="col-md-6">
                            <i class="fas fa-envelope mr-4"></i>{{$orderDetails['email']}}
                        </div>
                        <div class="col-md-6">
                            <div class="row text-warning">
                                <div class="col-md-6">
                                    <i class="fas fa-hand-holding-usd mr-4"></i> Sub total: 
                                </div>
                                <div class="col-md-6">
                                    ${{number_format($orderDetails['sub-total'],2,'.','')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row text-warning">
                                <div class="col-md-6">
                                    <i class="fas fa-coins mr-4"></i>Tax: 
                                </div>
                                <div class="col-md-6">
                                    ${{number_format($orderDetails['tax'],2,'.','')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6">
                            <div class="row text-warning">
                                <div class="col-md-6">
                                    <i class="fas fa-money-bill mr-4"></i>Total: 
                                </div>
                                <div class="col-md-6">
                                    {{number_format($orderDetails['total'],2,'.','')}}
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @if($orderDetails['pizza'])
                        @php
                            $i=1;    
                        @endphp
                        @foreach ($orderDetails['pizza'] as $pizza)
                        <div class="row my-2 border-top border-bottom">
                            <h5 class="font-weight-light">#Pizza {{$i}}</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6 row">
                                <b>Size:</b>{{$pizza->pizzaSize}}
                            </div>
                            <div class="col-md-6 row">
                                <b>Dough:</b>{{$pizza->pizzaDough }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 row">
                                <b>Sauce:</b>{{ $pizza->pizzaSauce}}
                            </div>
                            <div class="col-md-6 row">
                                <b>Sauce Amount:</b>{{$pizza->pizzaSauceAmount}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 row">
                               <b>Cook:</b>{{ $pizza->pizzCook }}
                            </div>
                            <div class="col-md-6 row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <div class="row border-top mt-1">
                            <div class="col-md-10">
                                <p class=""><b>Toppings:</b></p>
                                <div class="col-md-12">
                                    @if($pizza->toppings)
                                        {{$pizza->toppings}} <br/>
                                    @endif
                                    @if($pizza->toppingsRight)
                                        RH > {{$pizza->toppingsRight}} <br/>
                                    @endif
                                    @if($pizza->toppingsLeft)
                                        LH > {{$pizza->toppingsLeft}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <b>Price: </b>${{ $pizza->price }}
                            </div>
                        </div>
                        @php
                            $i++
                        @endphp
                        @endforeach 
                        @endif
                        @if(count($orderDetails['wings'])>0)
                        <div class="row border-top">
                            <h5 class="font-weight-bold">
                                Wings
                            </h5>   
                        </div>
                        @foreach($orderDetails['wings'] as $wings)
                        <div class="row">
                            <div class="col-md-10">
                                {{$wings->wingName}} <br/>
                                <p class="text-primary"><b>Sauce:</b> {{$wings->wingOption}}</p>
                            </div>
                            <div class="col-md-2">
                                ${{$wings->wingPrice}}
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @if(count($orderDetails['breads'])>0)
                        <div class="row border-top">
                            <h5 class="font-weight-bold">
                                Bread
                            </h5>   
                        </div>
                        @foreach($orderDetails['breads'] as $bread)
                        <div class="row">
                            <div class="col-md-10">
                                {{$bread->breadName}} <br/>
                                @if($bread->options)
                                <div class="col-md-12">
                                    <p class="text-center font-weight-light">{{$bread->options}}</p>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-2">
                               ${{$bread->breadPrice}}
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @if(count($orderDetails['pops'])>0)
                        <div class="row border-top">
                            <h5 class="font-weight-bold">
                                Pop
                            </h5>   
                        </div>
                        @foreach($orderDetails['pops'] as $pop)
                        <div class="row">
                            <div class="col-md-10">
                                {{$pop->popName}}
                            </div>
                            <div class="col-md-2">
                                ${{$pop->popPrice}}
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @if(count($orderDetails['sides'])>0)
                        <div class="row border-top">
                            <h5 class="font-weight-bold">
                                Side
                            </h5>   
                        </div>
                        @foreach($orderDetails['sides'] as $side)
                        <div class="row">
                            <div class="col-md-10">
                                {{$side->sideName}}
                            </div>
                            <div class="col-md-2">
                                ${{$side->sidePrice}}
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection