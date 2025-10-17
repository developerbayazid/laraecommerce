<?php

namespace App\Http\Controllers;

use App\Models\Product;


class HomeController extends Controller
{
    public function index() {
        $products = Product::latest()->take(4)->get();
        return view('index', compact('products'));
    }

    public function shop() {
        $products = Product::paginate(4);
        return view('components.frontend.shop', compact('products'));
    }
}
