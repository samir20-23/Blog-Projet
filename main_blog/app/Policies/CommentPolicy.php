<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->is_admin) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }

    public function view(User $user, Comment $comment): bool
    {
        return true;
    }

    public function create(?User $user): bool
    {
        return true; // Everyone can comment (we have moderation)
    }

    public function update(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id || $user->hasRole('admin') || $user->hasRole('editor');
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }

    public function approve(User $user, Comment $comment): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }
}
