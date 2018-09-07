<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Product $product) {

        $query = Product::query();
        if (session('cart')) {
            $query->whereNotIn(($product)->getKeyName(), session('cart'));
        }

        return view('products.index')->with('products', $query->get());
    }
}
