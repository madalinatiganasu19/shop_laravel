<h2>Thank you for buying from us.</h2>
<p>Here are your order details: </p>

<table>
    @foreach($products as $product)
        <tr>
            <td><img src="{{\Illuminate\Support\Facades\URL::to('/') . \Illuminate\Support\Facades\Storage::url(('images/' . $product->image))}}"></td>
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
</table>

