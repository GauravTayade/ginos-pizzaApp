<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DB;
use Arr;
use App\Wing;

class WingController extends Controller
{
    
    public function index(){

        $wings = Wing::orderBy('priority','ASC')->get();

        return view('wings')->with('wings',$wings);

    }

    public function saveWings(Request $request){

        $controller = App::make('\App\Http\Controllers\OrderController');

        $id   = $request->input('id');
        $sauce= $request->input('option');
        $mix  = $request->input('sauceMix'); 
        $searchedWing = Wing::find($id);

        $wing = array(
            "wingId"    =>$searchedWing['wingId'],
            "wingName"  =>$searchedWing['wingName'],
            "wingCode"  =>$searchedWing['wingCode'],
            "wingDesc"  =>$searchedWing['wingDesc'],
            "wingImage" =>$searchedWing['wingImage'],
            "wingPrice" =>$searchedWing['wingPrice'],
            "option"    => $mix."-".$sauce 
        );

        if($request->session()->has('order')){
            $order = $request->session()->get('order');
            if(Arr::exists($order,'wings')){
                array_push($order['wings'],$wing);
                $order['sub-total'] += $wing['wingPrice'];
                $order['tax'] = Round($controller->callAction('calculateTax', [$order['sub-total']]),2);
                $order['total'] = $order['sub-total']+$order['tax'];
                $request->session()->put('order',$order);
                return response()->json([
                    'result' => 'success',
                ]);
            }else{
                return response()->json([
                    'result' => 'error',
                ]);
            }
        }

    }

    public function deleteWings(Request $request,$wingId){

        $controller = App::make('\App\Http\Controllers\OrderController');

        if($request->session()->has('order')){
            $order = $request->session()->get('order');
            if(Arr::exists($order,'wings')){
                foreach($order['wings'] as $key=>$wing)
                {
                    if($wing['wingId'] == $wingId){
                        $order['sub-total'] -= $wing['wingPrice'];
                        $order['tax'] = Round($controller->callAction('calculateTax', [$order['sub-total']]),2);
                        $order['total'] = Round($order['sub-total']+$order['tax'],2);
                        Arr::forget($order['wings'],$key);
                    }
                }
            }
        }
        $request->session()->put('order',$order);
        return redirect('/checkout');

    }

}
