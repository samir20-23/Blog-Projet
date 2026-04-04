<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Services\ArticleService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService;
    protected $categoryService;

    public function __construct(ArticleService $articleService, CategoryService $categoryService)
    {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
    }

    public function home()
    {
        $featuredArticles = Article::with(['category', 'user'])
            ->where('is_featured', true)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        $articles = $this->articleService->getPublishedArticles(12);
        $categories = $this->categoryService->getAllCategories();

        return view('home', compact('articles', 'featuredArticles', 'categories'));
    }

    public function show($slug)
    {
        $article = Article::with(['category', 'user', 'comments.user', 'tags'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $this->articleService->incrementViews($article);
        
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function category(Category $category)
    {
        $articles = Article::where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        return view('articles.category', compact('category', 'articles'));
    }

    public function storeComment(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'article_id' => 'required|exists:articles,id',
            'name' => 'required_if:auth,false|string|max:255',
            'email' => 'required_if:auth,false|email|max:255',
        ]);

        $article = Article::findOrFail($validated['article_id']);
        
        $comment = $article->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'name' => auth()->check() ? auth()->user()->name : ($validated['name'] ?? 'Guest'),
            'email' => auth()->check() ? auth()->user()->email : ($validated['email'] ?? ''),
            'status' => 'pending'
        ]);

        return back()->with('success', __('Your comment has been submitted for moderation.'));
    }
}