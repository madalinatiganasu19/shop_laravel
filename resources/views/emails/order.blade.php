<h2>{{__('Hello, ') . $name}}</h2>
<h3>{{__('Thank you for buying from us.')}}</h3>
<p>{{__('Here are your order details: ')}}</p>

<table>
    <tr>
        <th></th>
        <th></th>
        <th>{{ __('PRODUCT DETAILS') }}</th>
    </tr>
    @foreach($products as $product)
        <tr>
            <td><img width="100%" src="{{\Illuminate\Support\Facades\URL::to('/') . \Illuminate\Support\Facades\Storage::url(('images/' . $product->image))}}"></td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>
                <h4>{{ $product->title }}</h4>
                <p>{{ $product->description }}</p>
                <h4>
                    {{ __("$") }}
                    {{ $product->price }}
                </h4>
            </td>
        </tr>
    @endforeach
        <tr>
            <th>&nbsp;&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;&nbsp;</th>
            <th>{{__('TOTAL: $') . $total}}</th>
        </tr>
</table>

<p><em>{{__('OBSERVATIONS: ') . $comments}}</em></p>

