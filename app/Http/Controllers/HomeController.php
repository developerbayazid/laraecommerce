<?php

namespace App\Http\Controllers;

use App\Models\Product;


class HomeController extends Controller
{
    public function index() {
        $products = Product::latest()->take(4)->get();
        return view('frontend.index', compact('products'));
    }

    public function shop() {
        $products = Product::paginate(4);
        return view('frontend.product.shop', compact('products'));
    }

    public function single_product($id) {
        $product = Product::findOrFail($id);
        $products = Product::latest()->take(4)->get();
        return view('frontend.product.single', compact('product', 'products'));
    }
}
