<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySubscribersJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(
        public Article $article
    ) {}

    public function handle(): void
    {
        //
    }
}