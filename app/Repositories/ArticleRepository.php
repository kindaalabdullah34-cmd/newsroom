<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAll(?string $search = null)
   {
    return Cache::remember(
        'articles_' . $search . '_page_' . request('page', 1),

        now()->addMinutes(10),

        function () use ($search) {

            return Article::with([
                'user',
                'tags',
                'comments'
            ])
            ->withCount('comments')
            ->when($search, function ($query) use ($search) {

                $query->where(
                    'title',
                    'like',
                    "%{$search}%"
                );
            })
            ->latest()
            ->paginate(10);
        }
    );
    }

    public function findById(int $id): ?Article
    {
        return Cache::remember(
            'article.' . $id,

            now()->addMinutes(10),

            function () use ($id) {

                return Article::with([
                    'user',
                    'tags',
                    'comments'
                ])
                ->withCount('comments')
                ->find($id);
            }
        );
    }

    public function create(array $data): Article
    {
        return Article::create($data);
    }

    public function update(
        Article $article,
        array $data
    ): bool {

        return $article->update($data);
    }

    public function delete(
        Article $article
    ): bool {

        return $article->delete();
    }
}
 