<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return view('admin.category.index');
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'category' => 'required'
        ],[
            'category.required' => 'Please enter a category name before submitting.'
        ]);

        $category = new Category();
        $category->category = $validated['category'];
        $category->save();
        return redirect()->back()->with('category-message', 'Category added successfully!');
    }

    public function view() {
        $categories = Category::all();
        return view('admin.category.view', compact('categories'));
    }

    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('delete-category', 'The category has been deleted successfully!');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.update', compact('category'));
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);
        $validated = $request->validate([
            'category' => 'required'
        ],[
            'category.required' => 'Please enter a category name before submitting.'
        ]);
        $category->category = $validated['category'];
        $category->save();
        return redirect()->back()->with('update-category', 'The category has been updated successfully!');
    }
}
