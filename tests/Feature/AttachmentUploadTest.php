<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Mail\ArticlePublishedMail;
use App\Jobs\NotifySubscribersJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttachmentUploadTest extends TestCase
{
    use RefreshDatabase;

public function test_writer_can_upload_attachment()
    {
        Mail::fake();
        Queue::fake();

        $writer = User::factory()->create([
            'role' => 'writer'
        ]);

        $token = $writer
            ->createToken('test')
            ->plainTextToken;

        $this->withToken($token)
            ->postJson('/api/v1/articles', [
                'title' => 'Laravel Published Article',
                'content' => str_repeat('content ', 20),
                'status' => 'published'
            ])
            ->assertStatus(201);

        Mail::assertQueued(
            ArticlePublishedMail::class
        );

        Queue::assertPushed(
            NotifySubscribersJob::class
        );
    }
}