<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles & Permissions
        $roles = [
            'admin' => 'Administrator with full access',
            'editor' => 'Can manage all content but not settings',
            'author' => 'Can create and manage their own content',
            'subscriber' => 'Public user with comment access'
        ];

        foreach ($roles as $slug => $description) {
            Role::create([
                'name' => ucfirst($slug),
                'slug' => $slug,
                'description' => $description
            ]);
        }

        $adminRole = Role::where('slug', 'admin')->first();

        // 2. Clear & Create Admin User
        User::where('email', 'samir@gmail.com')->delete();
        $admin = User::create([
            'name' => 'Samir Barca',  
            'email' => 'samir@gmail.com',
            'password' => Hash::make('samirsamir'),
            'is_admin' => true,
            'status' => 'active'
        ]);
        $admin->roles()->attach($adminRole->id);

        User::factory(10)->create();

        // 3. Categories (Premium Names)
        $categories = [
            'Digital Innovation' => 'Exploring the next frontier of technological advancements.',
            'Brand Identity' => 'The art and science of building memorable brand experiences.',
            'Minimalist Design' => 'Focusing on the essential elements of modern aesthetics.',
            'Tech Trends' => 'Latest updates from the world of computing and AI.',
            'Business Strategy' => 'Mastering the market with data-driven insights.'
        ];

        foreach ($categories as $name => $description) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
                'status' => 'active'
            ]);
        }

        // 4. Tags
        $tags = ['Laravel', 'Vite', 'TailwindCSS', 'AI', 'SaaS', 'Marketing', 'UI/UX'];
        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
                'status' => 'active'
            ]);
        }

        // 5. Articles (Premium "Store-like" Content)
        $categoryIds = Category::pluck('id')->toArray();
        $tagIds = Tag::pluck('id')->toArray();

        $titles = [
            'The Future of Modular CMS Architecture',
            'Why Minimalism is Taking Over Digital Design',
            'Building Reusable Laravel Starter Kits',
            'The Rise of AI-Driven Content Generation',
            'How to Scale Your Business in 2024',
            'Mastering Tailwind CSS for High-End Projects'
        ];

        foreach ($titles as $index => $title) {
            $article = Article::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'excerpt' => 'An in-depth look into ' . strtolower($title) . ' and how it shapes the industry standard.',
                'content' => "## Understanding the Core Concepts\n\nThis article dives deep into the fundamentals of " . strtolower($title) . ". We explore the various methodologies and practical implementations that define success in this domain.\n\n### Key Takeaways\n\n1. Innovation is the first step towards transformation.\n2. Strategy and execution must be perfectly aligned.\n3. Content is the bridge between your brand and the world.\n\n### Practical Implementation\n\nWhen building with " . strtolower($title) . ", always consider the long-term scalability of your architecture. Using a modular approach ensures that your project remains maintainable and elegant.\n\n> \"The best way to predict the future is to create it.\" - Peter Drucker\n\nIn conclusion, staying ahead depends on your ability to adapt and refactor constantly.",
                'status' => 'published',
                'published_at' => now()->subDays($index),
                'user_id' => $admin->id,
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'is_featured' => $index < 3,
                'views' => rand(100, 5000)
            ]);

            $article->tags()->sync(array_rand(array_flip($tagIds), 3));

            // 6. Comments
            Comment::create([
                'content' => 'This is exactly what I was looking for. The modular approach is a game changer!',
                'article_id' => $article->id,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'status' => 'approved'
            ]);
        }

        // 7. Settings
        $settings = [
            ['key' => 'site_name', 'display_name' => 'Site Name', 'value' => 'Modular CMS', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'display_name' => 'Site Description', 'value' => 'The ultimate Laravel starter kit.', 'type' => 'text', 'group' => 'general'],
            ['key' => 'admin_email', 'display_name' => 'Admin Email', 'value' => 'admin@example.com', 'type' => 'text', 'group' => 'general'],
            ['key' => 'items_per_page', 'display_name' => 'Items Per Page', 'value' => '12', 'type' => 'text', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}