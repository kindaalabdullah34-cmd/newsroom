<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class ArticlePublishedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Article $article
    ) {}

    public function build()
    {
        return $this
            ->subject('Article Published')
            ->view('emails.article-published')
            ->with([
                'article' => $this->article
            ]);
    }
}