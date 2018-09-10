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

    public function product(Request $request) {

        if (!session('logged')) {
            return redirect()->route('login');
        }

        $product = Product::find($request->get('id'));

        if ($request->post('save')) {

            $request->validate([
                'title' => 'required',
                'description' => 'required|min:20',
                'price' => 'required|numeric',
                'image' => 'required|image'
            ]);

            if (!$request->get('id')) {

                $product = new Product();
                $product->title = $request->input('title');
                $product->description = $request->input('description');
                $product->price = $request->input('price');
                $product->image =  $request->file('image')->getClientOriginalName();

                $product->save();

                $request->file('image')->storeAs('public/images', $product->image);

                return redirect()->route('products');

            } else {

                $product = Product::find($request->get('id'));

                $product->title = $request->input('title');
                $product->description = $request->input('description');
                $product->price = $request->input('price');
                $product->image =  $request->file('image')->getClientOriginalName();

                $product->save();

                $request->file('image')->storeAs('public/images', $product->image);

                return redirect()->route('products');
            }
        }

        return view('products.create')->with('product', $product);

    }
}
