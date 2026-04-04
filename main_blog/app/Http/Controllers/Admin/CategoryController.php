<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->authorizeResource(Category::class, 'category');
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->createCategory($request->validated());
        return redirect()->route('admin.categories.index')->with('success', app_term('category') . ' ' . __('successfully created.'));
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')->where('id', '!=', $category->id)->get();
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryService->updateCategory($category, $request->validated());
        return redirect()->route('admin.categories.index')->with('success', app_term('category') . ' ' . __('successfully updated.'));
    }

    public function destroy(Category $category)
    {
        try {
            $this->categoryService->deleteCategory($category);
            return redirect()->route('admin.categories.index')->with('success', app_term('category') . ' ' . __('successfully deleted.'));
        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')->with('error', $e->getMessage());
        }
    }
}
