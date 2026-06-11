<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Notifications\NewCommentNotification;

class CommentController extends Controller
{
    public function store(
        Request $request,
        Article $article
    ): JsonResponse {

        $request->validate([
            'body' => ['required', 'string']
        ]);

        $comment = Comment::create([
            'body' => $request->body,
            'article_id' => $article->id,
            'user_id' => Auth::id(),
        ]);

        if ($article->user_id !== Auth::id()) {
            $article->user->notify(
                new NewCommentNotification($comment)
            );
        }

        return response()->json([
            'message' => 'Comment created successfully',
            'data' => $comment
        ], 201);
    }
}