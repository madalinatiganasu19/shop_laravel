@extends('layouts.app')

@section('content')

    @if (count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-5">
                    <div class="card-header">{{__('Login')}}</div>

                    <div class="card-body">
                        <form method="POST">
                            @csrf

                            <div class="form-group">
                                <div class="col-md-6 offset-3">
                                    <input type="text" class="form-control" name="email" placeholder="{{__('E-Mail Address')}}" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 offset-3">
                                    <input type="password" class="form-control" name="password" placeholder="{{__('Password')}}">
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="col-md-8 offset-md-3">
                                    <input type="submit" class="btn btn-dark" name="login" value="{{__('Login')}}">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection
