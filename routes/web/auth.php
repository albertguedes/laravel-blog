<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController as Auth;

// User login
Route::get('/auth/login', [Auth::class, 'login'])->name('auth.login');
Route::post('/auth/login', [Auth::class, 'authenticate'])->name('auth.login.authenticate');

// User register
Route::get('/auth/register', [Auth::class, 'register'])->name('auth.register');
Route::post('/auth/register', [Auth::class, 'store'])->name('auth.register.store');

// User confirm register.
Route::get('/auth/register/confirm/{token}', [Auth::class, 'registerConfirm'])->name('auth.register.confirm');

// Password forget
Route::get('/auth/password/forget', [Auth::class, 'passwordForget'])->name('auth.password.forget');
Route::post('/auth/password/forget', [Auth::class, 'passwordForgetUpdate'])->name('auth.password.forget.update');

// User logout
Route::middleware('auth')->group(function () {
    Route::post('/auth/logout', [Auth::class, 'logout'])->name('auth.logout');
});
