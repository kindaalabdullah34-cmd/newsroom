<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\V1\ArticleController as V1ArticleController;

use App\Http\Controllers\Api\V2\ArticleController as V2ArticleController;

use App\Http\Controllers\Api\V1\CommentController;

use App\Http\Controllers\Api\V1\AttachmentController;
/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::post(
    '/login',
    [AuthController::class, 'login']
);

/*
|--------------------------------------------------------------------------
| V1 API
|--------------------------------------------------------------------------
*/

Route::prefix('v1')
    ->middleware([
        'auth:sanctum',
        'throttle:api'
    ])
    ->group(function () {

    Route::get(
        'articles',
        [V1ArticleController::class, 'index']
    );

    Route::get(
        'articles/{article}',
        [V1ArticleController::class, 'show']
    );

    Route::post(
        'articles',
        [V1ArticleController::class, 'store']
    )->middleware('role:admin,writer');

    Route::put(
        'articles/{article}',
        [V1ArticleController::class, 'update']
    )->middleware('role:admin,writer');

    Route::delete(
        'articles/{article}',
        [V1ArticleController::class, 'destroy']
    )->middleware('role:admin');

    Route::post(
    'articles/{article}/comments',
    [CommentController::class, 'store']
    );

    Route::post(
    'articles/{article}/attachments',
    [AttachmentController::class, 'store']
    )->middleware('role:admin,writer');

});
/*
|--------------------------------------------------------------------------
| V2 API
|--------------------------------------------------------------------------
*/

Route::prefix('v2')
    ->middleware(['auth:sanctum', 'throttle:api'])
    ->group(function () {

    Route::apiResource(
        'articles',
        V2ArticleController::class
    );
});
 