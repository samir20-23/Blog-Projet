<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Article;
<<<<<<< HEAD
use App\Models\Category; 
use App\Models\Tag;
use App\Models\User;
=======
use App\Models\Category;
use App\Models\Tag;

>>>>>>> 38a1a3d5adc149b3b8a49289f3090f4fbdfb0ffd
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 

class ArticleController extends Controller
{
    public function checkRole()
    {
        // return   $this->checkRole();
        if (!auth()->check()) {
            session()->flash('error', 'You must be logged in to view this page.');
            redirect()->route('login');
        } else if (auth()->user()->role == 'user') {
            return redirect()->route('articles.index')->with('error', 'You must be an admin to view this page.');
        }
        return null;
    } 

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
<<<<<<< HEAD
        return view('articles.create', compact('users', 'categories', 'tags'));
=======

        return view('articles.create', compact('users', 'categories','tags'));
>>>>>>> 38a1a3d5adc149b3b8a49289f3090f4fbdfb0ffd
    }

    public function store(Request $request)
    {

        // Check if user is logged in
      
    
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
        return   $this->checkRole();
        $article = Article::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();  
        return view('articles.edit', compact('article', 'categories', 'tags'));   
    }
    

    public function update(Request $request, string $id)
    {return   $this->checkRole();

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
    {return   $this->checkRole();

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