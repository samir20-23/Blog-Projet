<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
        $this->authorizeResource(Article::class, 'article');
    }

    public function index()
    {
        $articles = $this->articleService->getAllArticles();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $tags = Tag::all();
        return view('admin.articles.create', compact('categories', 'tags'));
    }

    public function store(StoreArticleRequest $request)
    {
        $this->articleService->createArticle($request->validated());
        return redirect()->route('admin.articles.index')->with('success', app_term('article') . ' ' . __('successfully created.'));
    }

    public function edit(Article $article)
    {
        $categories = Category::where('status', 'active')->get();
        $tags = Tag::all();
        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->articleService->updateArticle($article, $request->validated());
        return redirect()->route('admin.articles.index')->with('success', app_term('article') . ' ' . __('successfully updated.'));
    }

    public function destroy(Article $article)
    {
        $this->articleService->deleteArticle($article);
        return redirect()->route('admin.articles.index')->with('success', app_term('article') . ' ' . __('successfully deleted.'));
    }
}
