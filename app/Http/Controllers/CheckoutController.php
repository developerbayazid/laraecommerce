<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){

        $carts = Cart::where('user_id', Auth::id())->get();

        $cartCount = '';
        if (Auth::check()) {
            $cartCount = Auth::user()->carts()->count();
        }

        return view('frontend.checkout.index', ['cartCount' => $cartCount, 'carts' => $carts]);
    }


}
