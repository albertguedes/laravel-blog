<?php

declare(strict_types=1);

use App\Http\Controllers\CategoriesController as Categories;
use Illuminate\Support\Facades\Route;

Route::get('/categories', [Categories::class, 'index'])->name('categories');
Route::get('/category/{category}', [Categories::class, 'show'])->name('category');
