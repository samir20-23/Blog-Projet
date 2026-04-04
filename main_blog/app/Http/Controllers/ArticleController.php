<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'user'])->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.articles.create', compact('categories','tags'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags_id' => 'nullable|exists:tags,id',
        ]);
        Article::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category_id'] ?? null,
            'tags_id' => $validatedData['tags_id'] ?? 1,
            'user_id' => auth()->id() ?? 1,
        ]);
        return redirect()->route('admin.articles.index');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags_id' => 'nullable|exists:tags,id',
        ]);
        $article->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category_id'] ?? null,
            'tags_id' => $validatedData['tags_id'] ?? 1,
        ]);
        return redirect()->route('admin.articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index');
    }

    public function show(Article $article)
    {
        $article->load(['category', 'user', 'comments.user', 'tag']);
        return view('articles.show', compact('article'));
    }

    public function home()
    {
        $articles = Article::with(['category', 'user'])->latest()->get();
        return view('home', compact('articles'));
    }
}