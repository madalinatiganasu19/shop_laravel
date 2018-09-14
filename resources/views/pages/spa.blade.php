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

        <form class="checkout-form my-4" method="POST">
            @csrf
            <div class="form-group">
                <input class="form-control name" type="text" name="name" placeholder="{{__('Name')}}">
            </div>
            <div class="form-group">
                <input class="form-control email" type="text" name="email" placeholder="{{__('Email')}}">
            </div>
            <div class="form-group">
                <textarea class="form-control comments" rows="5" type="text" name="comments" placeholder="{{__('Comments')}}"></textarea>
            </div>
            <div class="form-group text-right">
                <input class="btn btn-dark checkout" type="submit" name="checkout" value="{{__('Checkout')}}">
            </div>
        </form>
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
                                    <input type="text" id ="email" class="form-control" placeholder="{{__('E-Mail Address')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 offset-3">
                                    <input type="password" id="password" class="form-control" placeholder="{{__('Password')}}">
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="col-md-8 offset-md-3">
                                    <input type="submit" id="loginBtn" class="btn btn-dark" value="{{__('Login')}}">
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

    <div class="page product">
        <!-- The index element where the products list is rendered -->
        <form class="my-4" method="POST">
            @csrf
            <div class="form-group">
                <input class="form-control title" type="text" placeholder="{{__('Title')}}">
            </div>
            <div class="form-group">
                <textarea class="form-control description" rows="5" type="text" placeholder="{{__('Description')}}"></textarea>
            </div>
            <div class="form-group">
                <input class="form-control price" type="text" placeholder="{{__('Price')}}">
            </div>
            <div class="form-group">
                <input type="file">
            </div>
            <div class="form-group text-right">
                <input class="btn btn-dark" type="submit" value="{{__('Save')}}">
            </div>
        </form>
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
