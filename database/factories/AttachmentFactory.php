<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'file' => 'test.pdf',
            'attachable_id' => Article::factory(),
            'attachable_type' => \App\Models\Article::class
        ];
    }
}
 