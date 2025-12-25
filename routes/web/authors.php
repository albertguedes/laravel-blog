<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthorsController as Authors;

Route::get('/authors', [Authors::class, 'index'])->name('authors');
Route::get('/author/{author}', [Authors::class, 'show'])->name('author');
