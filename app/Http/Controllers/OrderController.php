<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function checkout(Request $request){
        
        $order = array();
        
        $order = $request->session()->get('order');
        $customer = $request->session()->get('customer');
        $orderid = date('ymdHis');
        $order['order_id'] = $orderid;
        $request->session()->put('order',$order);
        return view('checkout')->with('order',$order);
    }

    public function calculateTax($price){
        return $price*0.13;
    }
    
}
