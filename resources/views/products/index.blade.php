@extends('layouts.app')

@section('content')

    <table>
        @foreach($products as $product)
        <tr>
            <td><img src="images/{{ $product->image }}"></td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>
                <h5>{{ $product->title }}</h5>
                <p>{{ $product->description }}</p>
                <p>
                    {{ __("$") }}
                    {{ $product->price }}
                </p>
            </td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td><a href="?id={{ $product->id }}">{{ __("ADD") }}</a></td>
        </tr>
        @endforeach
    </table>

@endsection
