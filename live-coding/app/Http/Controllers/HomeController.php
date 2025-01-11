<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $articles = Article::all();
        $categorys = Category::all();
        $tags = Tags::all();
        $users = User::all();

        return view('home', compact('articles','categorys','tags','users'));
    }
}
