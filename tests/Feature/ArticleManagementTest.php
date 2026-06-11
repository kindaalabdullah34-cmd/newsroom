<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_view_articles()
    {
        $this->getJson('/api/v1/articles')
            ->assertStatus(401);
    }

    public function test_authenticated_user_can_view_articles()
    {
        $user = User::factory()->create();

        $token = $user->createToken('test')->plainTextToken;

        Article::factory()->count(3)->create();

        $this->withToken($token)
            ->getJson('/api/v1/articles')
            ->assertStatus(200);
    }

    public function test_writer_can_create_article()
    {
        $writer = User::factory()->create([
            'role' => 'writer'
        ]);

        $token = $writer->createToken('test')->plainTextToken;

        $this->withToken($token)
            ->postJson('/api/v1/articles', [
                'title' => 'Laravel News',
                'content' => str_repeat('content ', 20),
                'status' => 'draft'
            ])
            ->assertStatus(201);

        $this->assertDatabaseHas('articles', [
            'title' => 'Laravel News'
        ]);
    }

    public function test_reader_cannot_create_article()
    {
        $reader = User::factory()->create([
            'role' => 'reader'
        ]);

        $token = $reader->createToken('test')->plainTextToken;

        $this->withToken($token)
            ->postJson('/api/v1/articles', [
                'title' => 'Laravel',
                'content' => 'test content'
            ])
            ->assertStatus(403);
    }

    public function test_article_validation()
    {
        $writer = User::factory()->create([
            'role' => 'writer'
        ]);

        $token = $writer->createToken('test')->plainTextToken;

        $this->withToken($token)
            ->postJson('/api/v1/articles', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title',
                'content'
            ]);
    }

    public function test_admin_can_soft_delete_article()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $article = Article::factory()->create();

        $token = $admin->createToken('test')->plainTextToken;

        $this->withToken($token)
            ->deleteJson("/api/v1/articles/{$article->id}")
            ->assertStatus(200);

        $this->assertSoftDeleted('articles', [
            'id' => $article->id
        ]);
    }
}