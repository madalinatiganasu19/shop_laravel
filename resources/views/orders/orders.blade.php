@extends('layouts.app')

@section('content')

    <table class="mx-auto">

        <tr class="bg-dark text-white text-center">
            <th><p class="lead">{{__('NAME')}}</p></th>
            <th>&nbsp;&nbsp;&nbsp;</th>
            <th><p class="lead">{{__('EMAIL')}}</p></th>
            <th>&nbsp;&nbsp;&nbsp;</th>
            <th><p class="lead">
                    {{__('TOTAL')}}
                </p>
            </th>
            <th></th>
            <th></th>
        </tr>

        @foreach ($orders as $order)
            <tr>
                <td><p >{{ $order->name }}</p></td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td><p>{{ $order->email }}</p></td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td><p >
                        {{ __("$") }}
                        {{ $order->total }}
                    </p>
                </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td><a href="{{route('order')}}?id={{ $order->id }}" class="btn btn-sm btn-dark">{{__('View Order')}}</a></td>
            </tr>
        @endforeach
    </table>

@endsection
