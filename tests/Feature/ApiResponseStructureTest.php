<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiResponseStructureTest extends TestCase
{
    use RefreshDatabase;

    public function test_articles_index_structure()
    {
        $user = User::factory()->create();

        $token = $user
            ->createToken('test')
            ->plainTextToken;

        Article::factory()->count(3)->create();

        $this->withToken($token)
            ->getJson('/api/v1/articles')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'meta'
            ]);
    }

    public function test_article_show_hides_sensitive_data()
    {
        $user = User::factory()->create();

        $token = $user
            ->createToken('test')
            ->plainTextToken;

        $article = Article::factory()->create();

        $this->withToken($token)
            ->getJson("/api/v1/articles/{$article->id}")
            ->assertStatus(200)
            ->assertJsonMissingPath('data.user.password')
            ->assertJsonMissingPath('data.user.remember_token');
    }
}