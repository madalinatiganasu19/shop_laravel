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

            return redirect()->route('/');
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
     * @return \Illuminate\Http\Response
     */
    public function cart(Request $request)
    {
        return view('pages.cart');
    }

    /**
     * Display a login form.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
    }

}
