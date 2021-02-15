<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::post('/dashboard','OrderDashboard@index');
Route::get('/getDashboard','OrderDashboard@show');
Route::get('/checkout','OrderController@checkout');

Route::get('/pizza','PizzaController@index');
Route::post('/savePizza','PizzaController@savePizza');
Route::get('/removePizza/{pizzaKey}','PizzaController@deletePizza');

Route::get('/breads','BreadsController@index');
Route::post('/addBread','BreadsController@saveBread');
Route::get('/removeBread/{breadId}','BreadsController@deleteBread');
Route::post('/calculatePrice','BreadsController@calculatePrice');

Route::get('/pops','PopController@index');
Route::Post('/addPop','PopController@savePop');
Route::get('/removePop/{popId}','PopController@deletePop');

Route::get('/wings','WingController@index');
Route::Post('/addWings','WingController@saveWings');
Route::get('/removeWing/{wingId}','WingController@deleteWings');

Route::get('/salad','SideController@index');
Route::Post('/addSide','SideController@saveSide');

Route::get('/getOrders','CheckoutController@getOrders');
Route::get('/getOrder','CheckoutController@getOrder');

Route::get('/sendOrder','CheckoutController@saveOrder');
Route::get('/inOven/{orderId}','CheckoutController@orderInoven');
Route::get('/ordersListInOven','CheckoutController@getInOvenOrders');
Route::get('/completedOrder/{orderId}','CheckoutController@orderComplete');
Route::get('/readyOrders','CheckoutController@getCompletedOrder');
Route::get('/pickedUp/{orderId}','CheckoutController@pikcedUP');