<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController as Profile;
use App\Http\Controllers\PostsController as Posts;

Route::middleware('auth')->group(function ()
{
    /**
     * User profile management
     */
    Route::get('/profile', [Profile::class, 'index'])->name('profile');

    Route::get('/profile/edit', [Profile::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [Profile::class, 'update'])->name('profile.update');

    Route::get('/profile/delete', [Profile::class, 'delete'])->name('profile.delete');
    Route::delete('/profile', [Profile::class, 'destroy'])->name('profile.destroy');

    /**
     * User password management
     */
    Route::get('/profile/password', [Profile::class, 'password'])->name('profile.password');
    Route::put('/profile/password', [Profile::class, 'passwordUpdate'])->name('profile.password.update');

    /**
     * User posts management
     */
    Route::get('/profile/posts', [Posts::class, 'index'])->name('profile.posts');

    Route::get('/profile/post/create', [Posts::class, 'create'])->name('profile.post.create');
    Route::post('/profile/post', [Posts::class, 'store'])->name('profile.post.store');

    Route::get('/profile/post/{post}', [Posts::class, 'show'])->name('profile.post');

    Route::get('/profile/post/{post}/edit', [Posts::class, 'edit'])->name('profile.post.edit');
    Route::put('/profile/post/{post}', [Posts::class, 'update'])->name('profile.post.update');

    Route::get('/profile/post/{post}/delete', [Posts::class, 'delete'])->name('profile.post.delete');
    Route::delete('/profile/post/{post}', [Posts::class, 'destroy'])->name('profile.post.destroy');
});
