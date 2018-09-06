<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class IndexController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        if ($request->get('id')) {
            session()->push('cart', $request->get('id'));

            return redirect()->route('index');
        }

        $query = Product::query();
        if (session('cart')) {
            $query->whereNotIn(($product)->getKeyName(), session('cart'));
        }

        return view('pages.index')->with('products', $query->get());
    }


    /**
     * Display a listing of the session cart resources.
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function cart(Request $request, Product $product)
    {
        if ($request->get('id')) {

            $products = session()->pull('cart');

            $id = array_search($request->get('id'), $products);
            unset($products[$id]);

            session()->put('cart', $products);

            return redirect()->route('cart');
        }


        if (session('cart')) {
            $query = Product::query()->whereIn(($product)->getKeyName(), session('cart'))->get();
        } else {
            $query = array();
        }

        return view('pages.cart')->with('products', $query);

    }

    /**
     * Validate customer credentials and send a confirmation email
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comments' => 'nullable'
        ]);

        return redirect()->route('index');
    }


    /**
     * Display a login form.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        return view('pages.login');
    }

}
