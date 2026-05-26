<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(
        Request $request
    ): array {

        return [

            'id' => $this->id,

            'title' => $this->title,

            'content' => $this->content,

            'status' => $this->status,

            'published_at' => $this->published_at,

            'author' => $this->user?->name,

            'created_at' => $this->created_at,
        ];
    }
}