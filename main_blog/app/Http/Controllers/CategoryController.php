<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

 public function store(Request $request)
{
    // Validate everything at once
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255'
    ]);

    // This creates ONE row with BOTH name and description
    Category::create($validatedData);

    return redirect()->route('admin.categories.index');
}

public function update(Request $request, Category $category)
{
    // Validate everything at once
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255'
    ]);

    // This updates the existing row with BOTH fields
    $category->update($validatedData);

    return redirect()->route('admin.categories.index');
}

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
