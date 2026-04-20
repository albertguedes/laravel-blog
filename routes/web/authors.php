<?php

declare(strict_types=1);

use App\Http\Controllers\AuthorsController as Authors;
use Illuminate\Support\Facades\Route;

Route::get('/authors', [Authors::class, 'index'])->name('authors');
Route::get('/author/{author}', [Authors::class, 'show'])->name('author');
