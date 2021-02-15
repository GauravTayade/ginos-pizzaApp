<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Bread;
use DB;
use Arr;

class BreadsController extends Controller
{
    
    public function index(){

        $breads = Bread::orderBy('priority','ASC')->get();
        return view('breads')->with('breads',$breads);

    }

    public function calculatePrice(Request $request){
        $breadPrice = Bread::find($request->id)['breadPrice'] + $request->optionCost;
        return response()->json(['Price'=>$breadPrice]);
    }

    public function saveBread(Request $request){

        $controller = App::make('\App\Http\Controllers\OrderController');

        $id = $request->input('id');
        $option = $request->input('option');
                
        $searchedBread = Bread::find($id);
       
        if($request->input('optionCost')){
            $optionCost = $request->input('optionCost');
            $breadPrice = $searchedBread['breadPrice']+$optionCost;
        }else{
            $breadPrice = $searchedBread['breadPrice'];
        }

        $bread = array(
            "breadId"       => $searchedBread['breadId'], 
            "breadName"     => $searchedBread['breadName'],
            "breadCode"     => $searchedBread['breadCode'],
            "breadDesc"     => $searchedBread['breadDesc'],
            "breadPrice"    => $breadPrice,
            'option'        => $option
        );

        dd($bread);

        if($request->session()->has('order')){
            $order = $request->session()->get('order');
            if(Arr::exists($order,'bread')){
                array_push($order['bread'],$bread);
                $order['sub-total'] += $bread['breadPrice'];
                $order['tax'] = Round($controller->callAction('calculateTax', [$order['sub-total']]),2);
                $order['total'] = Round($order['sub-total']+$order['tax'],2);
                $request->session()->put('order',$order);
                return response()->json([
                    'result'=>'success'
                ]);
            }else{
                return response()->json([
                    'result'=>'error'
                ]);            
            }
        }
    }

    public function deleteBread(Request $request,$breadId){

        $controller = App::make('\App\Http\Controllers\OrderController');

        if($request->session()->has('order')){
            $order = $request->session()->get('order');
            if(Arr::exists($order,'bread')){
                foreach($order['bread'] as $key=>$bread)
                {
                    if($bread['breadId'] == $breadId){
                        $order['sub-total'] -= $bread['breadPrice'];
                        $order['tax'] = Round($controller->callAction('calculateTax', [$order['sub-total']]),2);
                        $order['total'] = Round($order['sub-total']+$order['tax'],2);
                        Arr::forget($order['bread'],$key);
                    }
                }
            }
        }
        $request->session()->put('order',$order);
        return redirect('/checkout');
    }

}