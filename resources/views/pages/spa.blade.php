@extends('layouts.app')

@section('content')

    <!-- The index page -->
    <div class="page index">
        <!-- The index element where the products list is rendered -->
        <table class="list"></table>

    </div>

    <!-- The cart page -->
    <div class="page cart">
        <!-- Display errors -->
        <div class="alert alert-danger"></div>

        <!-- The cart element where the products list is rendered -->
        <table class="list"></table>

        <form class="checkout-form my-4" method="POST">
            @csrf
            <input type="hidden" name="checkout" value="1">

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

    <!-- The login page -->
    <div class="page login">
        <!-- Display errors -->
        <div class="alert alert-danger"></div>

        <!-- The cart element where the products list is rendered -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-5">
                    <div class="card-header">{{__('Login')}}</div>

                    <div class="card-body">
                        <form method="post" class="login-form">
                            @csrf
                            <input type="hidden" name="login" value="1">

                            <div class="form-group">
                                <div class="col-md-6 offset-3">
                                    <input type="text" name="email" class="form-control email" placeholder="{{__('E-Mail Address')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 offset-3">
                                    <input type="password" name="password" class="form-control password" placeholder="{{__('Password')}}">
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="col-md-8 offset-md-3">
                                    <input type="submit" name="login" class="btn btn-dark login" value="{{__('Login')}}">
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
        <!-- Display errors -->
        <div class="alert alert-danger"></div>

        <!-- The index element where the products list is rendered -->
        <form class="my-4 add-product" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="save" value="1">

            <div class="form-group">
                <input class="form-control title" type="text" name="title" placeholder="{{__('Title')}}">
            </div>

            <div class="form-group">
                <textarea class="form-control description" rows="5" type="text" name="description" placeholder="{{__('Description')}}"></textarea>
            </div>

            <div class="form-group">
                <input class="form-control price" type="text" name="price" placeholder="{{__('Price')}}">
            </div>

            <div class="form-group">
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input image" id="validatedCustomFile">
                    <label class="custom-file-label" for="validatedCustomFile">{{ __('Choose file...') }}</label>
                </div>
            </div>

            <div class="form-group text-right">
                <input  type="submit" name="save" class="btn btn-dark save" value="{{__('Save')}}">
            </div>
        </form>

        <div class="placeholder_image">
            @if (request()->get('id'))
                <img class="img-thumbnail" width="300rem" src="{{ \Illuminate\Support\Facades\Storage::url(('images/' . $product->image)) }}">
            @endif
        </div>
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
