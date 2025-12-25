<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriesController as Categories;

Route::get('/categories', [Categories::class, 'index'])->name('categories');
Route::get('/category/{category}', [Categories::class, 'show'])->name('category');
