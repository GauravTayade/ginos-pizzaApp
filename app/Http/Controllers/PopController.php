<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Pop;
use Arr;
use DB;

class PopController extends Controller
{
    
    public function index(){
        $pops = Pop::orderBY('priority')->get();

        return view('pop')->with('pops',$pops);

    }

    public function savePop(Request $request){

        $controller = App::make('\App\Http\Controllers\OrderController');

        $id = $request->input('id');
        $searchedPop = Pop::find($id);

        $pop = array(
            "popId"     => $searchedPop['popId'], 
            "popName"   => $searchedPop['popName'],
            "popCode"   => $searchedPop['popCode'],
            "popPrice"  => number_format($searchedPop['popPrice'],2,'.',''),
            "image"     => $searchedPop['image'] 
        );

        if($request->session()->has('order')){
            $order = $request->session()->get('order');
            if(Arr::exists($order,'pops')){
                array_push($order['pops'],$pop);
                $order['sub-total'] += $pop['popPrice'];
                $order['tax'] = Round($controller->callAction('calculateTax', [$order['sub-total']]),2);
                $order['total'] = $order['sub-total']+$order['tax'];
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

    public function deletePop(Request $request,$popId){
        
        $controller = App::make('\App\Http\Controllers\OrderController');

        if($request->session()->has('order')){
            $order = $request->session()->get('order');
            if(Arr::exists($order,'pops')){
                foreach($order['pops'] as $key=>$pop)
                {
                    if($pop['popId'] == $popId){
                        $order['sub-total'] -= $pop['popPrice'];
                        $order['tax'] = Round($controller->callAction('calculateTax', [$order['sub-total']]),2);
                        $order['total'] = Round($order['sub-total']+$order['tax'],2);
                        Arr::forget($order['pops'],$key);
                    }
                }
            }
        }
        $request->session()->put('order',$order);
        return redirect('/checkout');
    }
}
