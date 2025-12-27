<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController as Login;
use App\Http\Controllers\Auth\RegisterController as Register;
use App\Http\Controllers\Auth\PasswordForgotController as PasswordForgot;
use App\Http\Controllers\Auth\VerifyEmailController as VerifyEmail;

Route::middleware('guest')->group(function ()
{
    Route::get('auth/login', [Login::class, 'create'])->name('login');
    Route::post('auth/login', [Login::class, 'store'])->name('login.store');

    Route::get('auth/register', [Register::class, 'create'])->name('register');
    Route::post('auth/register', [Register::class, 'store'])->name('register.store');

    Route::get('auth/verify-email/resend', [VerifyEmail::class, 'edit'])->name('verify-email.resend');
    Route::post('auth/verify-email/resend', [VerifyEmail::class, 'update'])->name('verify-email.resend.update');

    // This route is a get, but dont has a view.
    Route::get('auth/verify-email/{token}', [VerifyEmail::class, 'index'])->name('verify-email');

    Route::get('auth/password/forgot', [PasswordForgot::class, 'index'])->name('password');
    Route::post('auth/password/forgot', [PasswordForgot::class, 'store'])->name('password.store');

    Route::get('auth/password/reset/{token}', [PasswordForgot::class, 'edit'])->name('password.reset');
    Route::post('auth/password/reset', [PasswordForgot::class, 'update'])->name('password.reset.update');
});

Route::middleware('auth')->group(function ()
{
    Route::post('auth/logout', [Login::class, 'destroy'])->name('logout');
});
