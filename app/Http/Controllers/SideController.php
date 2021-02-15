<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Salad;
use Arr;

class SideController extends Controller
{
    
    public function index(){

        $salad = Salad::orderBy('priority')->get();
        return view('sides')->with('sides',$salad);

    }

    public function saveSide(Request $request){

        $controller = App::make('\App\Http\Controllers\OrderController');

        $id = $request->input('id');
        $searchedSide = Salad::find($id);
        $side = array(
            "sideId"    => $searchedSide['sideId'],
            "sideName"  => $searchedSide['sideName'],
            "sideCode"  => $searchedSide['sideCode'],
            "sideImage" => $searchedSide['sideImage'],
            "options"   => $searchedSide['options'],
            "sidePrice" => $searchedSide['sidePrice'],
            "sideDesc"  => $searchedSide['sideDesc']
        );

        if($request->session()->has('order')){
            $order = $request->session()->get('order');
            if(Arr::exists($order,'sides')){
                array_push($order['sides'],$side);
                $order['sub-total'] += $side['sidePrice'];
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

    public function deleteSide(Request $request,$sideId){
        $controller = App::make('\App\Http\Controllers\OrderController');

        if($request->session()->has('order')){
            $order = $request->session()->get('order');
            dd($order);
            if(Arr::exists($order,'sides')){
                foreach($order['sides'] as $key=>$side)
                {
                    if($side['sideId'] == $sideId){
                        $order['sub-total'] -= $side['sidePrice'];
                        $order['tax'] = Round($controller->callAction('calculateTax', [$order['sub-total']]),2);
                        $order['total'] = Round($order['sub-total']+$order['tax'],2);
                        Arr::forget($order['sides'],$key);
                    }
                }
            }
        }
        $request->session()->put('order',$order);
        return redirect('/checkout');
    }

}
