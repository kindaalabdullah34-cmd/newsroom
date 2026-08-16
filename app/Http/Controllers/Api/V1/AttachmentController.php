<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AttachmentController extends Controller
{
    public function store(
        Request $request,
        Article $article
    ): JsonResponse {

        $request->validate([
            'file' => ['required', 'file']
        ]);

        $path = $request
            ->file('file')
            ->store(
                'attachments',
                'public'
            );

        $attachment = $article
            ->attachments()
            ->create([
                'file' => $path
            ]);

        return response()->json([
            'message' => 'Attachment uploaded successfully',
            'data' => $attachment
        ], 201);
    }
}
 