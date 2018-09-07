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

    <table>
        @foreach ($products as $product)
            <tr>
                <td><img class="img-thumbnail" src="{{\Illuminate\Support\Facades\Storage::url(('images/' . $product->image))}}"></td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td>
                    <p class="lead">{{ $product->title }}</p>
                    <p>{{ $product->description }}</p>
                    <p class="lead">
                        {{ __("$") }}
                        {{ $product->price }}
                    </p>
                </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td><a class="btn btn-dark" href="?id={{ $product->id }}">{{ __("Remove from Cart") }}</a></td>
            </tr>
        @endforeach
    </table>

    <form class="my-4" method="POST">
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="{{__('Name')}}" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="email" placeholder="{{__('Email')}}" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="5" type="text" name="comments" placeholder="{{__('Comments')}}">{{ old('comments') }}</textarea>
        </div>
        <div class="form-group text-right">
            <input class="btn btn-dark" type="submit" name="checkout" value="{{__('Checkout')}}">
        </div>
    </form>

@endsection

