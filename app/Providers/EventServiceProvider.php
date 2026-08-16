<?php

namespace App\Providers;

use App\Events\ArticleCreated;
use App\Events\ArticleUpdated;

use App\Listeners\SendArticleCreatedNotification;
use App\Listeners\SendArticleUpdatedNotification;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        ArticleCreated::class => [
            SendArticleCreatedNotification::class,
        ],

        ArticleUpdated::class => [
            SendArticleCreatedNotification::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
 