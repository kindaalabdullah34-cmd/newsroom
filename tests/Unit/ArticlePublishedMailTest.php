<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Mail\ArticlePublishedMail;

class ArticlePublishedMailTest extends TestCase
{
    public function test_subject_is_correct()
    {
        $article = new Article([
            'title' => 'Laravel'
        ]);

        $mail = new ArticlePublishedMail($article);

        $this->assertEquals(
            'Article Published',
            $mail->build()->subject
        );
    }

    public function test_mail_has_correct_writer()
    {
        $writer = new User([
            'email' => 'writer@test.com'
        ]);

        $article = new Article([
            'title' => 'Laravel'
        ]);

        $article->setRelation(
            'user',
            $writer
        );

        $mail = new ArticlePublishedMail(
            $article
        );

        $this->assertEquals(
            'writer@test.com',
            $mail->article->user->email
        );
    }
}