<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::withCount('articles')->orderBy('sort_order')->get();
    }

    public function createCategory(array $data)
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data)
    {
        if (isset($data['name']) && !isset($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $category->update($data);
        return $category;
    }

    public function deleteCategory(Category $category)
    {
        if ($category->articles()->exists()) {
            throw new \Exception(__('Cannot delete category with associated articles.'));
        }
        return $category->delete();
    }
}
