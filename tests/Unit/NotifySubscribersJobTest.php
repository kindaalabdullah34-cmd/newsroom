<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Article;
use App\Jobs\NotifySubscribersJob;

class NotifySubscribersJobTest extends TestCase
{
    public function test_job_receives_article()
    {
        $article = new Article([
            'id' => 1,
            'title' => 'Laravel'
        ]);

        $job = new NotifySubscribersJob(
            $article
        );

        $this->assertEquals(
            $article->id,
            $job->article->id
        );
    }
}