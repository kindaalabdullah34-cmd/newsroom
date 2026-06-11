<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Notifications\NewCommentNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_reader_can_add_comment()
    {
        $reader = User::factory()->create([
            'role' => 'reader'
        ]);

        $article = Article::factory()->create();

        $token = $reader
            ->createToken('test')
            ->plainTextToken;

        $this->withToken($token)
            ->postJson(
                "/api/v1/articles/{$article->id}/comments",
                [
                    'body' => 'Nice article'
                ]
            )
            ->assertStatus(201);

        $this->assertDatabaseHas(
            'comments',
            [
                'body' => 'Nice article',
                'article_id' => $article->id,
                'user_id' => $reader->id
            ]
        );
    }

    public function test_article_owner_receives_notification()
    {
        Notification::fake();

        $writer = User::factory()->create([
            'role' => 'writer'
        ]);

        $reader = User::factory()->create([
            'role' => 'reader'
        ]);

        $article = Article::factory()->create([
            'user_id' => $writer->id
        ]);

        $token = $reader
            ->createToken('test')
            ->plainTextToken;

        $this->withToken($token)
            ->postJson(
                "/api/v1/articles/{$article->id}/comments",
                [
                    'body' => 'Nice article'
                ]
            );

        Notification::assertSentTo(
            $writer,
            NewCommentNotification::class
        );

        Notification::assertNotSentTo(
            $reader,
            NewCommentNotification::class
        );
    }
}