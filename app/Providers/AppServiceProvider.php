<?php

namespace App\Providers;

use App\Models\Article;
use App\Observers\ArticleObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\ServiceProvider;

use App\Repositories\ArticleRepository;
use App\Repositories\ArticleRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Normal Binding
        $this->app->bind(
            ArticleRepositoryInterface::class,
            ArticleRepository::class
        );

        // Contextual Binding
        $this->app->when(
            \App\Services\ArticleService::class
        )
        ->needs(
            ArticleRepositoryInterface::class
        )
        ->give(
            ArticleRepository::class
        );
    }

    public function boot(): void
    {
        // Observer
        Article::observe(ArticleObserver::class);

        // Rate Limiting
        RateLimiter::for('api', function (Request $request) {

            $user = $request->user();

            if ($user && $user->role === 'admin') {

                return Limit::perMinute(100)
                    ->by($user->id);
            }

            return Limit::perMinute(20)
                ->by($request->ip());
        });
    }
}
 