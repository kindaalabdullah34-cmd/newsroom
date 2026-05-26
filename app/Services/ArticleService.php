<?php

namespace App\Services;

use App\Models\User;
use App\Models\Article;
use App\Events\ArticleCreated;
use App\Events\ArticleUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Repositories\ArticleRepositoryInterface;

class ArticleService
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository
    ) {}

    public function getAll(?string $search = null)
    {
        return $this->articleRepository
            ->getAll($search);
    }

    public function findById(int $id)
    {
        return $this->articleRepository
            ->findById($id);
    }

    public function create(array $data): Article
    {
        /** @var User|null $user */
        $user = Auth::user();

        abort_if(!$user, 401);

        $data['user_id'] = $user->id;

        $article = $this->articleRepository
            ->create($data);

        Cache::forget('articles.all');

        event(new ArticleCreated($article));

        return $article;
    }

    public function update(
        Article $article,
        array $data
    ): bool {

        Cache::forget('articles.all');

        Cache::forget(
            'article.' . $article->id
        );

        $updated = $this->articleRepository
            ->update($article, $data);

        event(new ArticleUpdated($article));

        return $updated;
    }

    public function delete(
        Article $article
    ): bool {

        Cache::forget('articles.all');

        Cache::forget(
            'article.' . $article->id
        );

        return $this->articleRepository
            ->delete($article);
    }
}