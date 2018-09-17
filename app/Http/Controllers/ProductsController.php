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

        if ($request->get('id')) {

            $id = $request->get('id');
            $product = Product::query()->find($id);

            Storage::delete('public/images/' . $product->image);
            $product->delete();

            if ($request->ajax()) {
                return ['success' => true];
            }
            return redirect()->route('products');
        }

        $products = Product::all();

        if ($request->ajax()) {
            return $products;
        }

        return view('products.products')->with('products', $products);
    }

    public function product(Request $request) {

        $product = Product::query()->find($request->get('id'));

        if ($request->post('save')) {
            if (!$request->get('id')) {

                $request->validate([
                    'title' => 'required',
                    'description' => 'required|min:20',
                    'price' => 'required|numeric',
                    'image' => 'required|image'
                ]);
                $product = new Product();

            } else {

                $request->validate([
                    'title' => 'required',
                    'description' => 'required|min:20',
                    'price' => 'required|numeric',
                    'image' => 'nullable|image'
                ]);
            }

            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');

            if ($request->file('image')) {
                $product->image =  $request->file('image')->store('');
                $request->file('image')->store('public/images');
            }

            $product->save();

            if ($request->ajax()) {
                return ['success' => true];
            }

            return redirect()->route('products');
        }

        if ($request->ajax()) {
            return $product;
        }

        return view('products.product')->with('product', $product);

    }
}
