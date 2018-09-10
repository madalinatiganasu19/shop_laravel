<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function __construct()
    {

    }

    public function products(Request $request) {

        if (!session('logged')) {
            return redirect()->route('login');
        }

        if ($request->get('id')) {

            $id = $request->get('id');
            $product = Product::query()->find($id);

            Storage::delete('public/images/' . $product->image);
            $product->delete();

            return redirect()->route('products');
        }

        $products = Product::all();
        return view('products.index')->with('products', $products);
    }

    public function product() {

        if (!session('logged')) {
            return redirect()->route('login');
        }
        return view('products.create');
    }
}
