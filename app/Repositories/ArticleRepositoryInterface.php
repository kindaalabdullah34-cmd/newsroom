<?php

namespace App\Repositories;

use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function getAll(
        ?string $search = null
    );

    public function findById(
        int $id
    ): ?Article;

    public function create(
        array $data
    ): Article;

    public function update(
        Article $article,
        array $data
    ): bool;

    public function delete(
        Article $article
    ): bool;
}