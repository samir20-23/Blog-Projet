<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    public function getAllArticles($perPage = 10)
    {
        return Article::with(['category', 'user', 'tags'])->latest()->paginate($perPage);
    }

    public function getPublishedArticles($perPage = 10)
    {
        return Article::with(['category', 'user', 'tags'])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest()
            ->paginate($perPage);
    }

    public function createArticle(array $data)
    {
        $data['user_id'] = Auth::id() ?? 1;
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        
        $article = Article::create($data);

        if (isset($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return $article;
    }

    public function updateArticle(Article $article, array $data)
    {
        if (isset($data['title']) && !isset($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $article->update($data);

        if (isset($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return $article;
    }

    public function deleteArticle(Article $article)
    {
        return $article->delete();
    }

    public function incrementViews(Article $article)
    {
        $article->increment('views');
    }
}
