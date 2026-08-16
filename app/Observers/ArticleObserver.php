<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Log;

class ArticleObserver
{
    public function created(
        Article $article
    ): void {

        Log::info(
            'Article created: ' .
            $article->title
        );
    }

    public function updated(
        Article $article
    ): void {

        Log::info(
            'Article updated: ' .
            $article->title
        );
    }

    public function deleted(
        Article $article
    ): void {

        Log::info(
            'Article deleted: ' .
            $article->title
        );
    }
}
 