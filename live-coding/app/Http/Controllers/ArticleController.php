<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category; 
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'tag'])->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('articles.create', compact('users', 'categories', 'tags'));
    }

    public function store(Request $request)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create an article.');
        }
    
        $userId = auth()->id();
    
        if (!$userId) {
            throw new \Exception('User ID is null');
        }
    
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags_id' => 'nullable|exists:tags,id', // Add validation for tags_id
        ]);
    
        Article::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category_id'] ?? null,
            'tags_id' => $validatedData['tags_id'] ?? 1, // Default value
            'user_id' => $userId,
        ]);
    
        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }   
    

    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();  
        return view('articles.edit', compact('article', 'categories', 'tags'));   
    }
    

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $article = Article::findOrFail($id);

        $article->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category_id'] ?? null,
        ]);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

    public function home()
    {
        $articles = Article::with('category')->get();
        return view('home', ['articles' => $articles]);
    }
}