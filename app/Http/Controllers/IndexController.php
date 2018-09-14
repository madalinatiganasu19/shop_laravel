<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Product;
use App\Mail\OrderConfirmation;

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
        if ($request->ajax()) {
            return $query->get();
        }
        return view('pages.index')->with('products', $query->get());
    }


    /**
     * Display a listing of the session cart resources.
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function cart(Request $request, Product $product, OrderConfirmation $orderConfirmation)
    {
        if ($request->get('id')) {

            $products = session()->pull('cart');

            $id = array_search($request->get('id'), $products);
            unset($products[$id]);

            session()->put('cart', $products);

            return redirect()->route('cart');
        }


        if (session('cart')) {
            $products = Product::query()->whereIn(($product)->getKeyName(), session('cart'))->get();
        } else {
            $products= array();
        }

        if ($request->post('checkout')) {

            if (!session('cart')) {
                return redirect()->route('cart');

            } else {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'comments' => 'nullable|min:2'
                ]);

                //create a new order and store it to database
                $order = new Order();
                $order->name = $request->input('name');
                $order->email = $request->input('email');
                $order->comments = $request->input('comments') ? $request->input('comments') : "";
                $order->save();

                //populate the pivot table
                $order->products()->attach($products);

                //send email
                Mail::to($request->input('email'))->send($orderConfirmation);
                session()->forget('cart');
                return redirect()->route('index');
            }
        }

        if ($request->ajax()) {
            return $products;
        }

        return view('pages.cart')->with('products', $products);

    }

    /**
     * Display a login form.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if ($request->post('login')) {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            $email = config('app.email');
            $password = config('app.password');

            if($request->input('email') === $email && $request->input('password') === $password) {
                session()->put('logged', $email);
                return redirect()->route('products');
            }
        }

        return view('pages.login');
    }

    public function logout() {
        session()->forget('logged');
        return redirect()->route('index');
    }

    public function spa() {
        return view('pages.spa');
    }

}
