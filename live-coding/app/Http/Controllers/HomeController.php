<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Retrieve the data
        $articles = Article::all();
        $categorys = Category::all();
        $comments = Comment::all();
        $tags = Tag::all();
        $users = User::all();

        // Check if the user is logged in
        if (!auth()->check()) {
            session()->flash('error', 'You must be logged in to view this page.');
            return redirect()->route('login');
        }

        // Check the user's role
        if (auth()->user()->role == 'user') {
            return view('home', compact('articles')); // For normal users, show articles only
        } else if (auth()->user()->role == 'admin') {
            // For admin users, show all the data
            return view('home', compact('articles', 'categorys', 'tags', 'users', 'comments'));
        }
    }
}
// adfja;lksdjf