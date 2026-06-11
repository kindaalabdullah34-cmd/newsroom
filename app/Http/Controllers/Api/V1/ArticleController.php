<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\ArticlePublishedMail;
use App\Jobs\NotifySubscribersJob;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\V1\ArticleResource;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleService $articleService
    ) {}

    public function index(): JsonResponse
    {
        $articles =$this->articleService
            ->getAll( request('search'));

        return response()->json([
            'data' => ArticleResource::collection(
                $articles
            ),
            'meta' => [
            'current_page' => $articles->currentPage(),
            'last_page' => $articles->lastPage(),
            'per_page' => $articles->perPage(),
            'total' => $articles->total(),
        ]
        ]);
    }

    public function show(int $id): JsonResponse
{
    $article = Article::findOrFail($id);

    $article->load([
        'user',
        'tags',
        'comments'
    ]);

    return response()->json([
        'data' => new ArticleResource($article)
    ]);
}

   public function store(StoreArticleRequest $request): JsonResponse
{
    $data = $request->validated();

    $user = Auth::user();

    $data['user_id'] = $user->id;

    $article = $this->articleService
        ->create($data);

    if ($article->status === 'published') {

        Mail::queue(
            new ArticlePublishedMail($article)
        );

        NotifySubscribersJob::dispatch(
            $article
        );
    }

    return response()->json([
        'message' => 'Article created successfully',
        'data' => new ArticleResource($article)
    ], 201);
}

public function update(
    UpdateArticleRequest $request,
    Article $article
): JsonResponse {

    $this->authorize('update', $article);

    $this->articleService->update(
        $article,
        $request->validated()
    );

    return response()->json([
        'message' => 'Article updated successfully',
         'article' => $article
    ]);
}

public function destroy(
    Article $article
): JsonResponse {

    $this->authorize('delete', $article);

    $this->articleService->delete($article);

    return response()->json([
        'message' => 'Article deleted successfully'
    ]);
}
}
