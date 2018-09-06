@extends('layouts.app')

@section('content')

    <table>
        @foreach($products as $product)
        <tr>
            <td><img class="img-thumbnail" src="{{\Illuminate\Support\Facades\Storage::url(('public/images/' . $product->image))}}"></td>
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
            <td><a href="?id={{ $product->id }}">{{ __("ADD") }}</a></td>
        </tr>
        @endforeach
    </table>

@endsection
