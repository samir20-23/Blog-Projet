<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // 1. IMPORTANT: Added this to link to the base controller
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        // 2. Added pagination (better for admin performance)
        $comments = Comment::with(['article', 'user'])
            ->latest()
            ->paginate(15);
            
        return view('admin.comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|min:3',
            'article_id' => 'required|exists:articles,id',
        ]);

        Comment::create([
            'content' => $validatedData['content'],
            'article_id' => $validatedData['article_id'],
            'user_id' => auth()->id(), // 3. Removed the hardcoded ID 1 for safety
        ]);

        return redirect()->back()->with('success', 'Comment added.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        // 4. Stay on the same page after deleting
        return redirect()->route('admin.comments.index')
                         ->with('success', 'Comment deleted successfully');
    }
}