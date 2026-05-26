<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendArticleNotification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Article $article
    ) {}

    public function handle(): void
    {
        Log::info(
            'New article created: ' .
            $this->article->title
        );
    }
}