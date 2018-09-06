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

        return view('products.index')->with('products', $query->get());
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function cart(Request $request)
    {
        return view('pages.cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
    }

}
