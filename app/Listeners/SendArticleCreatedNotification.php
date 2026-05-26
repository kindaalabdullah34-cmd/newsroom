<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Jobs\SendArticleNotification;

class SendArticleCreatedNotification
{
    public function handle(
        ArticleCreated $event
    ): void {

        SendArticleNotification::dispatch(
            $event->article
        );
    }
}