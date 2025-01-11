<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use App\Models\User;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['article', 'user'])->get();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        $users = User::all();
        $articles = Article::all(); 
        return view('comments.create', compact('users', 'articles'));
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
            'content' => 'required',
            'article_id' => 'nullable|exists:comment,id',
            'tags_id' => 'nullable|exists:tags,id', // Add validation for tags_id
        ]);
    
        Article::create([ 
            'content' => $validatedData['content'],
            'user_id' => $userId,
            'article_id' => $validatedData['article_id'] ?? null, 
        ]);
    
        return redirect()->route('comments.index')->with('success', 'Article created successfully!');
    }   
    

    public function edit(string $id)
    {
        $comment = Comment::findOrFail($id);
        $articles = Article::all(); 
        return view('comments.edit', compact('comment', 'articles'));   
    }
    

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([ 
            'content' => 'required',
            'article_id' => 'nullable|exists:articles,id',
        ]);

        $comment = Comment::findOrFail($id);

        $comment->update([ 
            'content' => $validatedData['content'],
            'article_id' => $validatedData['article_id'] ?? null,
        ]);

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully!');
    }

    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully.');
    }

    public function home()
    {
        $comments = Comment::with('Comment')->get();
        return view('home', ['comments' => $comments]);
    }
}