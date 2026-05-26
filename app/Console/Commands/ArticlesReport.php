<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ArticlesReport extends Command
{
    protected $signature =
        'articles:report';

    protected $description =
        'Generate articles report';

    public function handle(): void
    {
        $published = Article::where(
            'status',
            'published'
        )->count();

        $draft = Article::where(
            'status',
            'draft'
        )->count();

        $archived = Article::where(
            'status',
            'archived'
        )->count();

        $message =
            "Articles Report => " .
            "Published: {$published}, " .
            "Draft: {$draft}, " .
            "Archived: {$archived}";

        Log::info($message);

        $this->info($message);
    }
}