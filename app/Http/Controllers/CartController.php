<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        return view('frontend.cart.index');
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
