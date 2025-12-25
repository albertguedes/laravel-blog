<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/404', function () {
    return view('errors.404');
})->name('404');

Route::get('/500', function () {
    return view('errors.500');
})->name('500');

Route::get('/503', function () {
    return view('errors.503');
})->name('503');
