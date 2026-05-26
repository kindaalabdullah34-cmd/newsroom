<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class ArchiveArticles extends Command
{
    protected $signature =
        'articles:archive';

    protected $description =
        'Archive old published articles';

    public function handle(): void
    {
        $articles = Article::where(
            'status',
            'published'
        )
        ->where(
            'created_at',
            '<=',
            now()->subDays(30)
        )
        ->update([
            'status' => 'archived'
        ]);

        $this->info(
            $articles .
            ' articles archived successfully'
        );
    }
}