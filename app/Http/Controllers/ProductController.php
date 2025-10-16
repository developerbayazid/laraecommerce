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
            $image->move('products', $imageName);
            $product->product_image = $imageName;
        }

        $product->save();

        return redirect()->back()->with('add-product', 'The product has been added successfully!');
    }

    public function view() {

        $products = Product::paginate(12);
        return view('admin.product.view', compact('products'));
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $path = public_path('products/'. $product->product_image);
        if (file_exists($path)) {
            unlink($path);
        }
        $product->delete();
        return redirect()->back()->with('delete-product', $product->product_title .' has been deleted successfully!');
    }

}
