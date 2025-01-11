<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::all();
        return view('categorys.index', compact('categorys'));
    }

    public function create()
    { 
        $categorys = Category::all(); 
        return view('categorys.create', compact( 'categorys'));
    }

    public function store(Request $request)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create an category.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        Category::create([
            'name' => $validatedData['name'],
        ]);
    
        return redirect()->route('categorys.index')->with('success', 'Category created successfully!');
    }   
    

    public function edit(string $id)
    { 
        $category = Category::findOrFail($id); 
        return view('categorys.edit', compact( 'category'));   
    }
    

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('categorys.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categorys.index')->with('success', 'Category deleted successfully.');
    }
   
}