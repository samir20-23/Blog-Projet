<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'categories' => Category::count(),
            'comments' => Comment::where('status', 'pending')->count(),
            'users' => User::count(),
            'recent_articles' => Article::with('category')->latest()->take(5)->get(),
            'popular_articles' => Article::orderBy('views', 'desc')->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
