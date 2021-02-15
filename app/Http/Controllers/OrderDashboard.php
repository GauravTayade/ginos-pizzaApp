<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderDashboard extends Controller
{
    
    public function index(Request $request){
        
        $customer_details = array(
            'name' => $request->input("customerName"),
            'cell' => $request->input("customerCell"),
            'email' => $request->input("customerEmail")
        );
    
        $order = array(
            'order_id' =>'',
            'customer'  =>$customer_details,
            'pizza'     => array(),
            'bread'     => array(),
            'pops'      => array(),
            'wings'     => array(),
            'sides'     => array(),
            'special'   => array(),
            'sub-total' =>0.0,
            'tax'       =>0.0,
            'total'     =>0.0
        );

        $request->session()->put('order',$order);
        //$request->session()->put('customer',$customer_details);
        return view("orderDashboard");

    }

    public function show(){

        return view("orderDashboard");

    }

}
