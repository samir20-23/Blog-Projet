<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->is_admin) {
            return true;
        }
        return null;
    }

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Category $category): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }

    public function update(User $user, Category $category): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->hasRole('admin');
    }
}
