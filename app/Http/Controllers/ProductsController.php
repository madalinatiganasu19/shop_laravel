<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {

    }

    public function index(Product $product) {

        if (!session('logged')) {
            return redirect()->route('login');
        }

        $query = Product::query();
        if (session('cart')) {
            $query->whereNotIn(($product)->getKeyName(), session('cart'));
        }

        return view('products.index')->with('products', $query->get());
    }

    public function create() {

        if (!session('logged')) {
            return redirect()->route('login');
        }
        return view('products.create');
    }
}
