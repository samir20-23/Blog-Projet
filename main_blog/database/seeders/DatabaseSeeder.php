<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        $user = User::factory()->create([
            'name' => 'samir',  
            'email' => 'samir@gmail.com',
            'password' => Hash::make('samirsamir'),
            'is_admin' => true,
        ]);

        // FIX: Combine name and description into one array
        $categories = [
            'Web Development' => 'Web Development description',
            'Design' => 'Design description',
            'Data Science' => 'Data Science description'
        ];

        foreach ($categories as $name => $description) {
            Category::create([
                'name' => $name,
                'description' => $description
            ]);
        }
        
        $tags = ['Laravel', 'Vue.js', 'TailwindCSS', 'Python', 'AI'];
        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }

        $mainCategory = Category::first();
        $mainTag = Tag::first();

        $article = Article::create([
            'title' => 'The Future of Laravel in 2026',
            'content' => 'Laravel continues to dominate the PHP ecosystem with new features across AI integration, better developer experience, and more. Exploring how traditional frameworks adapt to modern standards.',
            'user_id' => $admin->id,
            'category_id' => $mainCategory->id,
            'tags_id' => $mainTag->id,
        ]);

        Comment::create([
            'content' => 'Great insights! I love the direction Laravel is moving.',
            'user_id' => $user->id,
            'article_id' => $article->id,
        ]);

        Comment::create([
            'content' => 'Really excited about the new AI features.',
            'user_id' => $admin->id,
            'article_id' => $article->id,
        ]);
    }
}