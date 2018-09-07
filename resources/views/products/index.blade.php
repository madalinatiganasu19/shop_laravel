@extends('layouts.app')

@section('content')

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
                <td>
                    <a class="btn btn-success my-1" href="{{ route('product') }}?id={{ $product->id }}">{{ __("Update") }}</a>
                    <a class="btn btn-danger my-1" href="?id={{ $product->id }}">{{ __("Delete") }}</a>
                </td>
            </tr>
        @endforeach
    </table>


@endsection
