<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function checkRole()
    {
        // return   $this->checkRole();
        if (!auth()->check()) {
            session()->flash('error', 'You must be logged in to view this page.');
            redirect()->route('login');
        } else if (auth()->user()->role == 'user') {
            return redirect()->route('home')->with('error', 'You must be an admin to view this page.');
        }
        return null;
    } 

    public function index()
    {
        return   $this->checkRole();

        $categorys = Category::all();
        return view('categorys.index', compact('categorys'));
    }


    public function create()
    {
        return   $this->checkRole();
        $categorys = Category::all();
        return view('categorys.create', compact('categorys'));
    }

    public function store(Request $request)
    {
        return   $this->checkRole();
       

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
        return   $this->checkRole();
         
                $category = Category::findOrFail($id);
                return view('categorys.edit', compact('category'));
         
    }


    public function update(Request $request, string $id)
    {
        return   $this->checkRole();
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
        return   $this->checkRole();
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categorys.index')->with('success', 'Category deleted successfully.');
    }
}
