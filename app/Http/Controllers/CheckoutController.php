<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Arr;

class CheckoutController extends Controller
{
    
    public function saveOrder(Request $request){
        $order = $request->session()->get('order');

        $order_id   = $order['order_id'];
        $customer   = $order['customer'];
        $pizza      = $order['pizza'];
        $bread      = $order['bread'];
        $pops       = $order['pops'];
        $wings      = $order['wings'];
        $sides      = $order['sides'];
        $special    = $order['special'];
     
        $order_insert = DB::table('orderinfo')->insertGetId([
            'orderNumber'   => $order_id,
            'name'          => $customer['name'],
            'phone'         => $customer['cell'],
            'email'         => $customer['email'],
            'subTotal'      => $order['sub-total'],
            'tax'           => $order['tax'],
            'total'         => $order['total']
        ]);

        if(!empty($pizza) && count($pizza)>0){
            
            foreach($pizza as $orderedPizza){
                
                $toppings=null;
                $toppingsRight=null;
                $toppingsLeft=null;
                
                if($orderedPizza['toppings']['right']){
                    $toppings_right = implode(',',$orderedPizza['toppings']['right']);
                    $toppingsRight= $toppings_right;
                }

                if($orderedPizza['toppings']['left']){
                    $toppings_left = implode(',',$orderedPizza['toppings']['left']);
                    $toppingsLeft= $toppings_left;
                }

                if($orderedPizza['toppings']['whole']){
                    $toppings_whole = implode(',',$orderedPizza['toppings']['whole']);
                    $toppings=$toppings_whole;
                }
            
                $pizza_insert = DB::table('order_pizza')->insertGetId([
                    'orderNumber'       => $order_id,
                    'pizzaSize'         => $orderedPizza['pizzaSize'], 
                    'pizzaDough'        => $orderedPizza['pizzaDough'],
                    'pizzaSauce'        => $orderedPizza['pizzaSauce'],
                    'pizzaSauceAmount'  => $orderedPizza['pizzaSauceAmount'],
                    'pizzCook'          => $orderedPizza['pizzCook'],
                    'toppingsLeft'      => $toppingsLeft,
                    'toppings'          => $toppings,
                    'toppingsRight'     => $toppingsRight,
                    'price'             => $orderedPizza['pizzaPrice']
                ]);

            }
        }

        if(!empty($bread) && count($bread)>0){

            foreach($bread as $orderedBread){

                $bread_insert = DB::table('order_bread')->insertGetId([
                    'orderNumber'   => $order_id,
                    'breadId'       => $orderedBread['breadId'],
                    'breadName'     => $orderedBread['breadName'],
                    'options'       => $orderedBread['option'],
                    'breadPrice'    => $orderedBread['breadPrice']
                ]);
            }    
        }

        if(!empty($pops) && count($pops)>0){

            foreach($pops as $orderedPops){
                $pops_insert = DB::table('order_pops')->insertGetId([
                    'orderNumber'  => $order_id,
                    'popId'        => $orderedPops['popId'],
                    'popName'      => $orderedPops['popName'],
                    'popPrice'     => $orderedPops['popPrice']
                ]);
            }
    
        }

        if(!empty($wings) && count($wings)>0){

            foreach($wings as $orderedWings){
                $wings_insert = DB::table('order_wings')->insertGetId([
                    'orderNumber'  => $order_id,
                    'wingId'       => $orderedWings['wingId'],
                    'wingName'     => $orderedWings['wingName'],
                    'wingPrice'    => $orderedWings['wingPrice'],
                    'wingOption'   => $orderedWings['option']
                ]);
            }              
        }

        if(!empty($sides) && count($sides)>0){
            
            foreach($sides as $orderedSides){
                
                $sides_insert = DB::table('order_sides')->insertGetId([
                    'orderNumber'  => $order_id,
                    'sideId'       => $orderedSides['sideId'],
                    'sideName'     => $orderedSides['sideName'],
                    'sidePrice'    => $orderedSides['sidePrice']
                ]);

            }  

        }

        if(!empty($special) && count($special)>0){
            
        }
        
        $request->session()->forget('order');
        
        $data = array('orderNumber'=>$order_id,'customer'=>$customer);
        
        return response()->view('orderCompleted',$data,200)->header("Refresh","15; url=/");;

    }

    public function getOrder(Request $request){
        
    }

    public function getOrders(){
        
        $ordersDeatilsList = array();
        $ordersList = DB::table('orderinfo')->where('status',0)->get();
        foreach($ordersList as $order){
            $orderDetails= array(
                'orderId'    => $order->orderId,
                'orderNumber'=> $order->orderNumber,
                'name'       => $order->name,
                'phone'      => $order->phone,
                'email'      => $order->email,
                'pizza'      => DB::table('order_pizza')->where('orderNumber',$order->orderNumber)->get(),
                'breads'     => DB::table('order_bread')->where('orderNumber',$order->orderNumber)->get(),
                'wings'      => DB::table('order_wings')->where('orderNumber',$order->orderNumber)->get(),
                'pops'       => DB::table('order_pops')->where('orderNumber',$order->orderNumber)->get(),
                'sides'      => DB::table('order_sides')->where('orderNumber',$order->orderNumber)->get(),
                //'specials'  => DB::table('order_specials')->where('orderNumber',$order->orderNumber)->get(),
                'sub-total'  => $order->subTotal,
                'tax'        => $order->tax,
                'total'      => $order->total
            );
            array_push($ordersDeatilsList,$orderDetails);
        }
    
        return view('/ordersList')->with('ordersDeatilsList',$ordersDeatilsList);

    }

    public function orderInoven($orderId){

        $result = DB::table('orderinfo')
                    ->where('orderId',$orderId)
                    ->update(['status'=>1]);
        if($result > 0){
            return redirect('/getOrders');
        }
    }

    public function getInOvenOrders(){

        $ordersDeatilsList = array();
        $ordersList = DB::table('orderinfo')->where('status',1)->get();
        foreach($ordersList as $order){
            $orderDetails= array(
                'orderId'    => $order->orderId,
                'orderNumber'=> $order->orderNumber,
                'name'       => $order->name,
                'phone'      => $order->phone,
                'email'      => $order->email,
                'pizza'      => DB::table('order_pizza')->where('orderNumber',$order->orderNumber)->get(),
                'breads'     => DB::table('order_bread')->where('orderNumber',$order->orderNumber)->get(),
                'wings'      => DB::table('order_wings')->where('orderNumber',$order->orderNumber)->get(),
                'pops'       => DB::table('order_pops')->where('orderNumber',$order->orderNumber)->get(),
                'sides'      => DB::table('order_sides')->where('orderNumber',$order->orderNumber)->get(),
                //'specials'  => DB::table('order_specials')->where('orderNumber',$order->orderNumber)->get(),
                'sub-total'  => $order->subTotal,
                'tax'        => $order->tax,
                'total'      => $order->total
            );
            array_push($ordersDeatilsList,$orderDetails);
        }
    
        return view('/orderListInOven')->with('ordersDeatilsList',$ordersDeatilsList);


    }

    public function orderComplete($orderId){

        $result = DB::table('orderinfo')
                    ->where('orderId',$orderId)
                    ->update(['status'=>2]);
        if($result > 0){
            return redirect('ordersListInOven');
        }

    }

    public function getCompletedOrder(){
        
        $ordersList = DB::table('orderinfo')->where('status',2)->get();
        return view('orderListReady')->with('orderListReady',$ordersList);
    }

    public function pikcedUP($orderId){
        $result = DB::table('orderinfo')
                    ->where('orderId',$orderId)
                    ->update(['status'=>3]);
        if($result > 0){
            return redirect('/readyOrders');
        }
    }

}
