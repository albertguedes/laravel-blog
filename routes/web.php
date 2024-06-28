<?php

use App\Http\Controllers\Admin\{
    AuthController as AdminAuth,
    CategoriesController as AdminCategories,
    DashboardController as AdminDashboard,
    PostsController as AdminPosts,
    ProfileController as AdminProfile,
    TagsController as AdminTags,
    UsersController as AdminUsers,
};

use App\Http\Controllers\{
    CategoriesController as Categories,
    ContactController as Contact,
    FeedController as Feed,
    PagesController as Pages,
    PostsController as Posts,
    SitemapController as Sitemap,
    TagsController as Tags
};

use Illuminate\Support\Facades\Route;

/**
 * Web Routes
 *
 * These routes are for the web and are loaded by the RouteServiceProvider within a group which
 * contains the "web" middleware group. Now create something great!
 */
Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        return redirect()->route('login');
    })->name('admin');

    Route::prefix('auth')->group(function () {
        Route::get('/login', [AdminAuth::class, 'login'])->name('login');
        Route::post('/login', [AdminAuth::class, 'authenticate'])->name('authenticate');

        Route::middleware('auth:web')->group(function () {
            Route::post('/logout', [AdminAuth::class, 'logout'])->name('logout');
        });
    });

    // douglas.turner abbigail.dickinson@example.org
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        Route::resource('/posts', AdminPosts::class);
        Route::get('/posts/{post}/delete', [AdminPosts::class, 'delete'])->name('posts.delete');

        Route::get('/profile', [AdminProfile::class, 'show'])->name('profile');
        Route::get('/profile/edit', [AdminProfile::class, 'edit'])->name('profile.edit');
        Route::put('/profile/edit', [AdminProfile::class, 'update'])->name('profile.update');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::resource('/users', AdminUsers::class);
        Route::get('/users/{user}/delete', [AdminUsers::class, 'delete'])->name('users.delete');

        Route::resource('/categories', AdminCategories::class);
        Route::get('/categories/{category}/delete', [AdminCategories::class, 'delete'])->name('categories.delete');

        Route::resource('/tags', AdminTags::class);
        Route::get('/tags/{tag}/delete', [AdminTags::class, 'delete'])->name('tags.delete');
    });

    Route::get('/403', function () {
        return view('admin.errors.403');
    })->name('403');
});

Route::get('/categories', [Categories::class, 'index'])->name('categories');
Route::get('/categories/{category}', [Categories::class, 'show'])->name('category');

Route::get('/tags', [Tags::class, 'index'])->name('tags');
Route::get('/tags/{tag}', [Tags::class, 'show'])->name('tag');

Route::get('/archive', [Posts::class, 'archive'])->name('archive');


Route::get('/about', [Pages::class, 'about'])->name('about');

Route::get('/contact', [Contact::class, 'index'])->name('contact');
Route::post('/contact', [Contact::class, 'sendmessage'])->name('sendmessage');

Route::get('/rss.xml', Feed::class)->name('rss');
Route::get('/sitemap.xml', Sitemap::class)->name('sitemap');

Route::get('/', [Posts::class, 'index'])->name('home');

/**
 * This route needs to be define at the end of the routes file because the
 * argument try to find any post with the slug written in the url.
 */
Route::get('/{post}', [Posts::class, 'show'])->name('post');
