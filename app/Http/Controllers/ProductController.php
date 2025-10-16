<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('admin.product.index', compact('categories'));
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'name'        => 'required',
            'category'    => 'required',
            'price'       => 'required|numeric|between:1,99999999999',
            'quantity'    => 'required|numeric|min:1',
            'description' => 'required',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product = new Product();

        $product->product_title       = $validated['name'];
        $product->product_category    = $validated['category'];
        $product->product_price       = $validated['price'];
        $product->product_quantity    = $validated['quantity'];
        $product->product_description = $validated['description'];

        $image = $validated['image'];

        if ($image) {
            $imageName = time() . '.'.$image->getClientOriginalExtension();
            $imagePath = $image->storeAs('products', $imageName, 'public');
            $product->product_image = $imagePath;
        }

        $product->save();

        return redirect()->back()->with('add-product', 'The product has been added successfully!');
    }
}
