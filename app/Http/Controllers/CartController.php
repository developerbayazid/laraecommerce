<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){

        $products = Cart::with('product')->where('user_id', Auth::id())->get()->pluck('product');

        $subtotal = 0;
        foreach ($products as $product) {
            $subtotal = $product->product_price + $subtotal;
        }

        $cartCount = '';
        if (Auth::check()) {
            $cartCount = Auth::user()->carts()->count();
        }
        return view('frontend.cart.index', ['cartCount' => $cartCount, 'products' => $products, 'subtotal' => $subtotal]);
    }

    public function store($id){
        $product = Product::findOrFail($id);
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->product_id = $product->id;

        $cart->save();

        return redirect()->back()->with('product-cart', 'Product has been added to the cart successfully!');
    }
}
