@extends('layouts.app')

@section('content')

    <!-- The index page -->
    <div class="page index">
        <!-- The index element where the products list is rendered -->
        <table class="list"></table>

    </div>

    <!-- The cart page -->
    <div class="page cart">
        <!-- The cart element where the products list is rendered -->
        <table class="list"></table>

    </div>

    <!-- The cart page -->
    <div class="page login">
        <!-- The cart element where the products list is rendered -->

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-5">
                    <div class="card-header">{{__('Login')}}</div>

                    <div class="card-body">
                        <form method="post" class="login-form">
                            @csrf
                            <div class="form-group">
                                <div class="col-md-6 offset-3">
                                    <input type="text" id ="email" class="form-control" name="email" placeholder="{{__('E-Mail Address')}}" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 offset-3">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="{{__('Password')}}">
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="col-md-8 offset-md-3">
                                    <input type="submit" id="loginBtn" class="btn btn-dark" name="login" value="{{__('Login')}}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- The products page -->
    <div class="page products">
        <!-- The index element where the products list is rendered -->
        <table class="list"></table>

    </div>

    <div class="page orders">
        <table class="mx-auto list">

        </table>

    </div>

    <div class="page order">
        <!-- The index element where the products list is rendered -->
        <table class="list"></table>

    </div>
@endsection
