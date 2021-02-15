@extends('layout.master')
@section('content')
    <div class="jumbotron jumbotron-fluid background-green text-white">
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                <div class="col-md-6">                    
                    <h1 class="display-4">Review Your Order</h1>
                    <p class="lead">welcome to Gino's Pizza Store Ordering System</p>
                </div>
                <div class="col-md-6">
                    <h4 class="display-4">Customer Details</h1>
                    <h6 class="font-weight-light">
                        <i class="fas fa-shipping-fast mr-4"></i>Order: #{{$order['order_id']}}
                    </h6>
                    <h6 class="font-weight-light">
                        <i class="fas fa-user mr-4"></i>{{$order['customer']['name']}}
                    </h6>
                    <h6 class="font-weight-light">
                        <i class="fas fa-phone-alt mr-4"></i>{{$order['customer']['cell']}}
                    </h6>
                    <h6 class="font-weight-light">
                        <i class="fas fa-envelope mr-4"></i>{{$order['customer']['email']}}
                    </h6>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 justify-content-center">
        <div class="row text-center col-md-12">
            <div class=" col-md-3">
                
            </div>
            <div class="col-md-6">
                <a href="/sendOrder" class="btn btn-success m-3">Confirm Order</a>
                {{-- <a href="#" id="sendOrder" class="btn btn-success m-3">Confirm Order</a> --}}
                <a href="/" class="btn btn-danger m-3">Cancel Order</a>
                <a href="/getDashboard" class="btn btn-warning m-3">Get Dashboard</a>
            </div>
            <div class="col-md-3">
            
            </div>
        </div>
        <div class="col-md-12 row d-flex justify-content-center">
            <div class="card text-white bg-secondary m-3 col-md-5 background-red custom-text">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <i class="fas fa-shopping-cart mr-4"></i>Order: #{{$order['order_id']}}
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <i class="fas fa-user mr-4"></i>{{$order['customer']['name']}}
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <i class="fas fa-phone-alt mr-4"></i>{{$order['customer']['cell']}}
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <i class="fas fa-envelope mr-4"></i>{{$order['customer']['email']}}
                        </div>
                    </div> 
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @if($order['pizza'])
                        @php
                         $i=1;   
                        @endphp
                        @foreach ($order['pizza'] as $key=>$pizza)
                        <div class="row col-md-12 border-top border-bottom">
                            <div class="col-md-6 my-2">
                                <h5 class="font-weight-light">#Pizza {{$i}}</h5>
                            </div>
                            <div class="col-md-6 my-2 text-right">
                                <a href="/removePizza/{{$key}}" class="btn btn-danger">
                                    <i class="fas fa-minus-circle"></i> Remove Pizza
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <b>Size: </b>{{ $pizza['pizzaSize']}}
                            </div>
                            <div class="col-md-8">
                                <b>Dough: </b>{{$pizza['pizzaDough'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <b>Sauce: </b>{{ $pizza['pizzaSauce']}}
                            </div>
                            <div class="col-md-8">
                                <b>Sauce Amount: </b>{{$pizza['pizzaSauceAmount'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <b>Cook: </b>{{ $pizza['pizzCook'] }}
                            </div>
                            <div class="col-md-8 text-right">
                        
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-10">
                            <p class=""><b>Toppings:</b></p>
                            @if($pizza['toppings']['whole'])
                                <div class="col-md-12">
                                    {{-- {{ implode(',',$pizza['toppings']['whole']) }} --}}
                                    @foreach($pizza['toppings']['whole'] as $whole)
                                        {{$whole}}<br/>
                                    @endforeach
                                </div>
                                @endif
                                @if($pizza['toppings']['left'])
                                <div class="col-md-6">
                                    <h6 class="text-left">Left ></h6>
                                    {{-- {{ implode(',',$pizza['toppings']['left']) }} --}}
                                    @foreach($pizza['toppings']['left'] as $left)
                                        {{$left}}<br/>
                                    @endforeach
                                </div>
                                @endif
                                @if($pizza['toppings']['right'])
                                <div class="col-md-6">
                                    <h6 class="text-left">Right ></h6>
                                    {{-- {{ implode(',',$pizza['toppings']['right']) }} --}}
                                    @foreach($pizza['toppings']['right'] as $right)
                                        {{$right}}<br/>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <b>Price: </b>${{ $pizza['pizzaPrice'] }}
                            </div>
                        </div>
                        @php
                            $i++;
                        @endphp
                        @endforeach 
                        @endif
                        @if($order['wings'])
                        <div class="row border-top">
                            <h5 class="font-weight-bold">
                                Wings
                            </h5>   
                        </div>
                        @foreach($order['wings'] as $wings)
                        <div class="row">
                            <div class="col-md-9">
                                {{$wings['wingName']}} <br/>
                                <p class="text-primary"><b>Sauce:</b> {{$wings['option']}}</p>
                            </div>
                            <div class="col-md-2 text-warning">
                                ${{$wings['wingPrice']}}
                            </div>
                            <div class="col-md-1 text-center">
                                <a href="/removeWing/{{$wings['wingId']}}" class="btn btn-danger mb-2"><i class="fas fa-minus-circle"></i></a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @if($order['bread'])
                        <div class="row border-top">
                            <h5 class="font-weight-bold">
                                Bread
                            </h5>   
                        </div>
                        @foreach($order['bread'] as $bread)
                        <div class="row">
                            <div class="col-md-9">
                                {{$bread['breadName']}} <br/>
                                @if($bread['option'])
                                <div class="col-md-12">
                                    <p class="text-center font-weight-light">{{$bread['option']}}</p>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-2 text-warning">
                               ${{$bread['breadPrice']}}
                            </div>
                            <div class="col-md-1 text-center">
                                <a href="/removeBread/{{$bread['breadId']}}" class="btn btn-danger mb-2"><i class="fas fa-minus-circle"></i></a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @if($order['pops'])
                        <div class="row border-top">
                            <h5 class="font-weight-bold">
                                Pop
                            </h5>   
                        </div>
                        @foreach($order['pops'] as $pop)
                        <div class="row">
                            <div class="col-md-9">
                                {{$pop['popName']}}
                            </div>
                            <div class="col-md-2 text-warning">
                                ${{$pop['popPrice']}}
                            </div>
                            <div class="col-md-1 text-center">
                                <a href="/removePop/{{$pop['popId']}}" class="btn btn-danger mb-2"><i class="fas fa-minus-circle"></i></a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @if($order['sides'])
                        <div class="row border-top">
                            <h5 class="font-weight-bold">
                                Side
                            </h5>   
                        </div>
                        @foreach($order['sides'] as $side)
                        <div class="row">
                            <div class="col-md-10">
                                {{$side['sideName']}}
                            </div>
                            <div class="col-md-2 text-warning">
                                ${{$side['sidePrice']}}
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div class="row border-top">
                            <div class="col-md-10">
                                Sub Total:
                            </div>
                            <div class="col-md-2">
                                ${{ $order['sub-total'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                Tax (13% HST):
                            </div>
                            <div class="col-md-2">
                                ${{$order['tax']}}
                            </div>
                        </div>
                        <div class="row border-top border-success">
                            <div class="col-md-10">
                               <b> Total: </b>
                            </div>
                            <div class="col-md-2">
                               <b> ${{ number_format($order['total'],2,'.','') }} </b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('js')
<script>
    $(document).ready(function(){
        $('#sendOrder').on('click',function(){
            window.print();
        })
    });
</script>
@endsection --}}