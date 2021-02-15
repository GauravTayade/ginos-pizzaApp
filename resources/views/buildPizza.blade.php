@extends('layout.master')
@section('content')

<div class="jumbotron jumbotron-fluid background-green text-white custom-margin">
    <div class="container text-center">
        <h1 class="display-4">Build Your Pizza</h1>
        <p class="lead">welcome to Gino's Pizza Store Ordering System</p>
    </div>
</div>
<form action="{{url('savePizza')}}" method="post">
@csrf
<div class="row col-md-12 justify-content-center custome-font mt-5">
    <div class="col-md-12 row">
        <div class="col-md-3">
            <label class="form-control"> Choose Size: </label> 
        </div>
        <div class="col-md-9">
            @foreach ($sizes as $size)
            <label class="btn btn-primary"> 
                {{ $size['size'].' - '.$size['sizeCode'] }}
                @if($size->priority == 1)
                    <input type="radio" name="pizzSize" id="pizzaSize" value="{{ $size['size'] }}" autocomplete="off" checked>
                @else
                    <input type="radio" name="pizzSize" id="pizzaSize" value="{{ $size['size'] }}" autocomplete="off">
                @endif
            </label>
            @endforeach
        </div>
    </div>
    <div class="col-md-12 row mt-5">
        <div class="col-md-3">
            <label class="form-control"> Choose Dough: </label> 
        </div>
        <div class="col-md-9">
            @foreach ($doughs as $dough)
            <label class="btn btn-primary"> 
                {{ $dough['doughName']}}
                @if($dough->priority == 1)
                    <input type="radio" name="pizzDough" id="pizzaDough" value="{{ $dough['doughName'] }}" autocomplete="off" checked>
                @else
                    <input type="radio" name="pizzDough" id="pizzaDough" value="{{ $dough['doughName'] }}" autocomplete="off">
                @endif
            </label>
            @endforeach
        </div>
    </div>
    <div class="col-md-12 row mt-5">
        <div class="col-md-3">
            <label class="form-control"> Choose Sauce: </label> 
        </div>
        <div class="col-md-9">
            @foreach ($sauces as $sauce)
            <label class="btn btn-primary"> 
                {{ $sauce['sauceName']}}
                @if($sauce->priority ==1)
                    <input type="radio" name="pizzaSauce" id="pizzaSauce" value="{{ $sauce['sauceName'] }}" autocomplete="off" checked>
                @else
                    <input type="radio" name="pizzaSauce" id="pizzaSauce" value="{{ $sauce['sauceName'] }}" autocomplete="off">
                @endif
            </label>
            @endforeach
        </div>
    </div>
    <div class="col-md-12 row mt-5">
        <div class="col-md-3">
            <label class="form-control"> Choose Sauce Amount: </label> 
        </div>
        <div class="col-md-9">
            @foreach ($sauceAmounts as $sauceAmount)
            <label class="btn btn-primary"> 
                {{ $sauceAmount['sauceAmountName']}}
                @if($sauceAmount->priority ==1)
                    <input type="radio" name="pizzaSauceAmount" id="pizzaSauceAmountCode" value="{{ $sauceAmount['sauceAmountName'] }}" autocomplete="off" checked>
                @else
                    <input type="radio" name="pizzaSauceAmount" id="pizzaSauceAmountCode" value="{{ $sauceAmount['sauceAmountName'] }}" autocomplete="off">
                @endif
            </label>
            @endforeach
        </div>
    </div>
    <div class="col-md-12 row mt-5">
        <div class="col-md-3">
            <label class="form-control"> Cook Type: </label> 
        </div>
        <div class="col-md-9">
            @foreach ($cookTypes as $cookType)
            <label class="btn btn-primary"> 
                {{ $cookType['cookName']}}
                @if($cookType->priority ==1)
                    <input type="radio" name="pizzCook" id="pizzaCook" value="{{ $cookType['cookName'] }}" autocomplete="off" checked>
                @else
                    <input type="radio" name="pizzCook" id="pizzaCook" value="{{ $cookType['cookName'] }}" autocomplete="off">
                @endif
            </label>
            @endforeach
        </div>
    </div>
    <div class="col-md-12 row mt-5">
        <div class="col-md-3">
            <label class="form-control"> Choose Toppings: </label> 
        </div>
        <div class="col-md-9">
           @php
            $i = 0;    
           @endphp
            <ul class="nav nav-tabs nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" role="tab" data-toggle="tab" href="#meat-menu">Meat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="tab" data-toggle="tab" href="#veg-menu">Veg</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="tab" data-toggle="tab" href="#cheese-menu">Cheese</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="tab" data-toggle="tab" href="#free-menu">Free</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="meat-menu" role="tabpanel" class="tab-pane active fade show">
                    <table class="col-md-8 text-center">
                        <tr>
                            <th></th>
                            <th>Left Side</th>
                            <th>Whole</th>
                            <th>Right Side</th>
                            <th>2X</th>
                        </tr>
                        @foreach ($toppings as $topping)
                        @if ($topping->type == 'M')
                        <tr>
                            <td>
                                <label class="btn btn-primary col-md-12"> 
                                    {{ $topping['toppingName'] }}
                                </label>
                            </td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'RH_'.$topping['toppingName'] }}"></td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'WH_'.$topping['toppingName'] }}"></td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'LH_'.$topping['toppingName'] }}"></td>
                            {{-- <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'DB_'.$topping['toppingName'] }}"></td> --}}
                            <td><input type="checkbox" data-topname="{{$topping['toppingName']}}" name="CHktoppings[<?= $i ?>][]" id="double"></td>
                        </tr>
                        @php
                            $i++    
                        @endphp
                        @endif
                        @endforeach
                    </table>
                </div>
                <div id="veg-menu" role="tabpanel" class="tab-pane fade">
                    <table class="col-md-8 text-center">
                        <tr>
                            <th></th>
                            <th>Left Side</th>
                            <th>Whole</th>
                            <th>Right Side</th>
                            <th>2X</th>
                        </tr>
                        @foreach ($toppings as $topping)
                        @if ($topping->type == 'V')
                        <tr>
                            <td>
                                <label class="btn btn-primary col-md-12"> 
                                    {{ $topping['toppingName'] }}
                                </label>
                            </td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'RH_'.$topping['toppingName'] }}"></td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'WH_'.$topping['toppingName'] }}"></td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'LH_'.$topping['toppingName'] }}"></td>
                            {{-- <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'DB_'.$topping['toppingName'] }}"></td> --}}
                            <td><input type="checkbox" data-topname="{{$topping['toppingName']}}" name="CHktoppings[<?= $i ?>][]" id="double"></td>
                        </tr>
                        @php
                            $i++    
                        @endphp
                        @endif
                        @endforeach
                    </table>
                </div>
                <div id="cheese-menu" role="tabpanel" class="tab-pane fade">
                    <table class="col-md-8 text-center">
                        <tr>
                            <th></th>
                            <th>Left Side</th>
                            <th>Whole</th>
                            <th>Right Side</th>
                            <th>2X</th>
                        </tr>
                        @foreach ($toppings as $topping)
                        @if ($topping->type == 'C')
                        <tr>
                            <td>
                                <label class="btn btn-primary col-md-12"> 
                                    {{ $topping['toppingName'] }}
                                </label>
                            </td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'RH_'.$topping['toppingName'] }}"></td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'WH_'.$topping['toppingName'] }}"></td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'LH_'.$topping['toppingName'] }}"></td>
                            {{-- <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'DB_'.$topping['toppingName'] }}"></td> --}}
                            <td><input type="checkbox" data-topname="{{$topping['toppingName']}}" name="CHktoppings[<?= $i ?>][]" id="double"></td>
                        </tr>
                        @php
                            $i++    
                        @endphp
                        @endif
                        @endforeach
                    </table>
                </div>
                <div id="free-menu" role="tabpanel" class="tab-pane fade">
                    <table class="col-md-8 text-center">
                        <tr>
                            <th></th>
                            <th>Left Side</th>
                            <th>Whole</th>
                            <th>Right Side</th>
                            <th>2X</th>
                        </tr>
                        @foreach ($toppings as $topping)
                        @if ($topping->type == 'F')
                        <tr>
                            <td>
                                <label class="btn btn-primary col-md-12"> 
                                    {{ $topping['toppingName'] }}
                                </label>
                            </td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'RH_'.$topping['toppingName'] }}"></td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'WH_'.$topping['toppingName'] }}"></td>
                            <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'LH_'.$topping['toppingName'] }}"></td>
                            {{-- <td><input type="radio" name="toppings[<?= $i ?>][]" value="{{ 'DB_'.$topping['toppingName'] }}"></td> --}}
                            <td><input type="checkbox" data-topname="{{$topping['toppingName']}}" name="CHktoppings[<?= $i ?>][]" id="double"></td>
                        </tr>
                        @php
                            $i++    
                        @endphp
                        @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center my-5">
        <input class="btn btn-success" type="submit" name="submit" value="Place My Order">
    </div>
</div>
</form>
@endsection
@section('js')
    <script src="{{URL::asset('js/products.js')}}" type="text/javascript"></script>
@endsection