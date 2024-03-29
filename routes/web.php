<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\SitemapController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function(){

    Route::get('/',function(){
        return redirect()->route('login');
    })->name('admin');

    Route::prefix('auth')->group(function(){
        Route::get('/login',[Admin\AuthController::class,'login'])->name('login');
        Route::post('/login',[Admin\AuthController::class,'authenticate'])->name('authenticate');
        Route::middleware('auth:web')->post('/logout',[Admin\AuthController::class,'logout'])->name('logout');
    });

    Route::middleware('auth')->group(function(){

        Route::get('/dashboard',[Admin\DashboardController::class,'index'])->name('dashboard');

        Route::get('/categories/{category}/delete',[Admin\CategoriesController::class,'delete'])->name('categories.delete');
        Route::resource('/categories',Admin\CategoriesController::class);

        Route::get('/tags/{tag}/delete',[Admin\TagsController::class,'delete'])->name('tags.delete');
        Route::resource('/tags',Admin\TagsController::class);

        Route::get('/posts/{post}/delete',[Admin\PostsController::class,'delete'])->name('posts.delete');
        Route::resource('/posts',Admin\PostsController::class);

        Route::get('/users/{user}/delete',[Admin\UsersController::class,'delete'])->name('users.delete');
        Route::resource('/users',Admin\UsersController::class);

        Route::get('/profile',[Admin\ProfileController::class,'show'])->name('profile');
        Route::get('/profile/edit',[Admin\ProfileController::class,'edit'])->name('profile.edit');
        Route::put('/profile/edit',[Admin\ProfileController::class,'update'])->name('profile.update');

    });

});

Route::get('/',[PostsController::class,'index'])->name('home');

Route::get('/archive',[PostsController::class,'archive'])->name('archive');

Route::get('/about',[PagesController::class,'about'])->name('about');

Route::get('/contact',[ContactController::class,'index'])->name('contact');

Route::post('/contact',[ContactController::class,'sendmessage'])->name('sendmessage');

Route::get('/rss.xml',FeedController::class)->name('rss');
Route::get('/sitemap.xml',SitemapController::class)->name('sitemap');
Route::get('/categories',[CategoriesController::class,'index'])->name('categories');
Route::get('/categories/{category}',[CategoriesController::class,'show'])->name('category');
Route::get('/tags',[TagsController::class,'index'])->name('tags');
Route::get('/tags/{tag}',[TagsController::class,'show'])->name('tag');
Route::get('/{post}',[PostsController::class,'show'])->name('post');

Route::get('/404',function(){
    return view('errors.404');
})->name('404');
