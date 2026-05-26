<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use Illuminate\Support\Facades\Log;

class HandleArticleUpdated
{
    public function handle(
        ArticleUpdated $event
    ): void {

        Log::info(
            'Article updated: ' .
            $event->article->title
        );
    }
}