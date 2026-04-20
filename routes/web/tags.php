<?php

declare(strict_types=1);

use App\Http\Controllers\TagsController as Tags;
use Illuminate\Support\Facades\Route;

Route::get('/tags', [Tags::class, 'index'])->name('tags');
Route::get('/tags/{tag}', [Tags::class, 'show'])->name('tag');
