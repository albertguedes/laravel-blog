<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArchiveController as Archive;
use App\Http\Controllers\IndexController as Index;
use App\Http\Controllers\ContactController as Contact;
use App\Http\Controllers\FeedController as Feed;
use App\Http\Controllers\SearchController as Search;
use App\Http\Controllers\SitemapController as Sitemap;

// Home Page
Route::get('/', [Index::class, 'index'])->name('home');

// About the blog page
Route::get('/about', [Index::class, 'about'])->name('about');

// Contact page
Route::get('/contact', [Contact::class, 'index'])->name('contact');
Route::post('/contact', [Contact::class, 'send'])->name('contact.send');

// Archive of posts page
Route::get('/archive', Archive::class)->name('archive');

// Search Page
Route::get('/search', Search::class)->name('search');

// RSS feed
Route::get('/rss.xml', Feed::class)->name('rss');

// Sitemap
Route::get('/sitemap.xml', Sitemap::class)->name('sitemap');

// Single post
// NOTE: this route needs to be the last one in the file to prevent conflicts
// with other routes
Route::get('/{post}', [Index::class, 'post'])->name('post');
