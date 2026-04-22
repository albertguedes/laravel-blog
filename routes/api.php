<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Admin\CategoriesController;
use App\Http\Controllers\Api\Admin\PostsController;
use App\Http\Controllers\Api\Admin\RolesController;
use App\Http\Controllers\Api\Admin\TagsController;
use App\Http\Controllers\Api\Admin\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('users', UsersController::class);
    Route::apiResource('roles', RolesController::class);
    Route::apiResource('tags', TagsController::class);
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('posts', PostsController::class);
});
