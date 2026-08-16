<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $writer = User::create([
            'name' => 'Writer User',
            'email' => 'writer@test.com',
            'password' => bcrypt('password'),
            'role' => 'writer'
        ]);

        Tag::insert([
            ['name' => 'Laravel'],
            ['name' => 'PHP'],
            ['name' => 'Backend'],
        ]);

        $tagIds = Tag::pluck('id')->toArray();

        for ($i = 1; $i <= 5; $i++) {

            $article = Article::create([
                'user_id' => $writer->id,
                'title' => 'Article ' . $i,
                'content' => str_repeat('Laravel advanced backend content ', 20),
                'status' => 'published',
                'published_at' => now(),
            ]);

            $article->tags()->sync($tagIds);

            Comment::create([
                'user_id' => $admin->id,
                'article_id' => $article->id,
                'body' => 'Great article'
            ]);
        }
    }
}
 