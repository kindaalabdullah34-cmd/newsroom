<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'title' => $this->title,

            'content' => $this->content,

            'status' => $this->status,

            'author' => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
            ],

            'comments_count' => $this->comments_count,

            'tags' => $this->tags
                ->pluck('name')
                ->values(),

            'reading_time' =>
                ceil(str_word_count($this->content) / 200)
                . ' min read',

            'created_at' => $this->created_at,
        ];
    }
}
 