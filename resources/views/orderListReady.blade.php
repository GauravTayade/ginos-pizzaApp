@extends('layout.master')
@section('content')

<div class="jumbotron jumbotron-fluid background-green text-white">
    <div class="container text-center">
        <h1 class="display-4">Ready Orders</h1>
        <p class="lead">welcome to Gino's Pizza Store Ordering System</p>
    </div>
</div>
<div class="col-md-12 text-center mb-5">
    <a href="{{URL::asset('/readyOrders') }}" class="btn btn-success col-md-2">Refresh</a>
</div>
<div class="col-md-12 justify-content-center custome-font">
    <div class="row d-flex justify-content-center">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#Order</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orderListReady as $orderReady)
                <tr>
                    <th scope="row">{{$orderReady->orderNumber}}</th>
                    <td>{{$orderReady->name}}</td>
                    <td>$ {{ number_format($orderReady->total,2,'.','')}}</td>
                    <td>Ready</td>
                    <th><a href="/pickedUp/{{$orderReady->orderId}}" class="btn btn-success">Completed</a></th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection