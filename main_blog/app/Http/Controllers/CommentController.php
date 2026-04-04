<?php
namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['article', 'user'])->get();
        return view('admin.comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required',
            'article_id' => 'required|exists:articles,id',
        ]);
        Comment::create([
            'content' => $validatedData['content'],
            'article_id' => $validatedData['article_id'],
            'user_id' => auth()->id() ?? 1,
        ]);
        return redirect()->back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
