<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Topping;
use App\Sauce;
use App\Size;
use App\Dough;
use App\CookType;
use App\SauceAmount;
use App\PizzaPrice;
Use DB;
Use Arr;

class PizzaController extends Controller
{
    
    public function index(Request $request){
                
        $sizes          = Size::orderBy('priority','ASC')->get();
        $doughs         = Dough::orderBy('priority','ASC')->get();
        $cookTypes      = CookType::orderBy('priority','ASC')->get();
        $toppings       = Topping::orderBy('toppingName')->orderBy('toppingName','ASC')->get();
        $sacues         = Sauce::orderBy('priority','ASC')->get();
        $sauceAmounts   = SauceAmount::orderBy('priority','ASC')->get(); 
        
        return view('buildPizza')->with('sizes',$sizes)
                                 ->with('doughs',$doughs)
                                 ->with('cookTypes',$cookTypes)
                                 ->with('toppings',$toppings)
                                 ->with('sauces',$sacues)
                                 ->with('sauceAmounts',$sauceAmounts);
    }

    public function savePizza(Request $request){

        $controller = App::make('\App\Http\Controllers\OrderController');

        $pizzaSize          = $request->input('pizzSize');
        $pizzaDough         = $request->input('pizzDough');
        $toppingsListArray  = $request->input('toppings');

        $toppingsList = array();
        
        foreach ($toppingsListArray as $topping) {
            array_push($toppingsList,$topping[0]);
        }
        
        $toppingsCount = 0;
        
        $right = array();
        $left = array();
        $whole = array();
        $double = array();
        
        foreach ($toppingsList as $topping) {
            $checkTopping = explode('_',$topping);            
        
            $toppingValue = Topping::select('toppingValue')->where('toppingName',$checkTopping[1])->first()->toppingValue;

            if(isset($checkTopping[2])){
                if($checkTopping[0] === 'LH' || $checkTopping[0] === 'RH'){
                    $checkToppingName = $checkTopping[1].'('.$checkTopping[2].')';
                    $toppingsCount += $toppingValue;
                }else{
                    $checkToppingName = $checkTopping[1].'('.$checkTopping[2].')';
                    $toppingsCount += $toppingValue*2; 
                }
            }else{
                
                if($checkTopping[0] === 'LH' || $checkTopping[0] === 'RH'){
                    $checkToppingName = $checkTopping[1];
                    $toppingsCount += $toppingValue/2;
                }else{
                    $checkToppingName = $checkTopping[1];
                    $toppingsCount += $toppingValue;
                }
                 
            }
 
            if($checkTopping[0] === 'LH'){
                array_push($left,$checkToppingName);
            }elseif($checkTopping[0] === 'RH'){
                array_push($right,$checkToppingName);
            }else{
                array_push($whole,$checkToppingName);    
            }
        }
        
        $price = PizzaPrice::select('pizzaPrice')->Where('pizzaSize',$pizzaSize)->where('pizzaToppingsCount',ceil($toppingsCount))->first()->pizzaPrice;
        
        
        $pizzaToppings['right']  = $right;
        $pizzaToppings['left']   = $left;
        $pizzaToppings['whole']  = $whole;
        $pizzaToppings['double'] = $double;

        $pizza = array(
            'pizzaId'           => rand(),
            'pizzaSize'         => $pizzaSize,
            'pizzaDough'        => $pizzaDough,
            'pizzaSauce'        => $request->input('pizzaSauce'),
            'pizzaSauceAmount'  => $request->input('pizzaSauceAmount'),
            'pizzCook'          => $request->input('pizzCook'),
            'toppings'          => $pizzaToppings,
            'pizzaPrice'        => $price
        );
        
        if($request->session()->has('order')){
            $order = $request->session()->get('order');

            if(Arr::exists($order,'pizza')){
                array_push($order['pizza'],$pizza);
                $order['sub-total'] += $pizza['pizzaPrice'];
                $order['tax'] = Round($controller->callAction('calculateTax', [$order['sub-total']]),2);
                $order['total'] = $order['sub-total']+$order['tax'];
            }else{
                
            }
        }
        
        $request->session()->put('order',$order);
        
        return view('success');
    }

    public function deletePizza(Request $request,$pizzaKey){
    
        $controller = App::make('\App\Http\Controllers\OrderController');

        if($request->session()->has('order')){
            $order = $request->session()->get('order');
            if(Arr::exists($order,'pizza')){
                foreach($order['pizza'] as $key=>$pizza)
                {
                    if($key == $pizzaKey){
                        $order['sub-total'] -= $pizza['pizzaPrice'];
                        $order['tax'] = Round($controller->callAction('calculateTax', [$order['sub-total']]),2);
                        $order['total'] = Round($order['sub-total']+$order['tax'],2);
                        Arr::forget($order['pizza'],$key);
                    }
                }
            }
        }
        $request->session()->put('order',$order);
        return redirect('/checkout');

    }

}
