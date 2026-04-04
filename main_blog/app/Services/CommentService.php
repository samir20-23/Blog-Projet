<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function getPendingComments()
    {
        return Comment::with(['user', 'article'])->where('status', 'pending')->latest()->paginate(20);
    }

    public function createComment(array $data)
    {
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
        }

        $data['status'] = 'pending'; // Default to moderation
        
        return Comment::create($data);
    }

    public function approveComment(Comment $comment)
    {
        return $comment->update(['status' => 'approved']);
    }

    public function rejectComment(Comment $comment)
    {
        return $comment->update(['status' => 'rejected']);
    }

    public function deleteComment(Comment $comment)
    {
        return $comment->delete();
    }
}
