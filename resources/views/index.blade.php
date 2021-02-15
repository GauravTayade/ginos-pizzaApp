@extends('layout.master')
@section('content')
    <div class="jumbotron jumbotron-fluid background-green text-white m-0">
        <div class="container">
            <h1 class="display-4">Welcome to Ordering System</h1>
            <p class="lead">welcome to Gino's Pizza Store Ordering System</p>
        </div>
    </div>
    <div class="col-md-12 row container-margin justify-content-center text-white pt-5">
        <div class="col-md-6">
        <form action="{{url('dashboard')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" name="customerName" class="form-control" id="inputName" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="inputCell">Cell</label>
                    <input type="text" name="customerCell" class="form-control" id="inputCell" placeholder="987-654-3210">
                    <small id="cellHelp" class="form-text text-muted">We'll never share your cell with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="inputEmail">email</label>
                    <input type="email" name="customerEmail" class="form-control" id="inputEmail" placeholder="example@mail.com">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <button type="submit" class="btn btn-primary">Continue</button>
              </form>
        </div>
    </div>
@endsection