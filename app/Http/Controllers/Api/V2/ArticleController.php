<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V2\ArticleResource;

class ArticleController extends Controller
{
    public function index(): JsonResponse
    {
        $articles = Article::with([

            'user',
            'tags',
            'comments'

        ])
        ->withCount('comments')
        ->paginate(10);

        return response()->json([

            'data' =>
                ArticleResource::collection(
                    $articles
                )

        ]);
    }

    public function show(
        Article $article
    ): JsonResponse {

        $article->load([
            'user',
            'tags',
            'comments'
        ]);

        $article->loadCount(
            'comments'
        );

        return response()->json([

            'data' =>
                new ArticleResource(
                    $article
                )

        ]);
    }
}
 