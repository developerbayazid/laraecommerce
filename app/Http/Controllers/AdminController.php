<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.category.index');
    }

    public function store(Request $request) {
        $category = new Category();
        $category->category = $request->category;
        $category->save();
        return redirect()->back()->with('category-message', 'Category added successfully!');
    }
}
