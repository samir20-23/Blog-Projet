<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;

class PagePolicy
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

    public function view(?User $user, Page $page): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }

    public function update(User $user, Page $page): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }

    public function delete(User $user, Page $page): bool
    {
        return $user->hasRole('admin');
    }
}
