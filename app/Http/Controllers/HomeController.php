<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $products = Product::latest()->take(4)->get();

        $cartCount = '';
        if (Auth::check()) {
            $cartCount = Auth::user()->carts()->count();
        }

        return view('frontend.index', ['products' => $products, 'cartCount' => $cartCount]);
    }
}
