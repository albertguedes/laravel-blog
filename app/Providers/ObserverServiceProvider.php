<?php declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Post;
use App\Observers\PostObserver;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Post::observe(PostObserver::class);
    }
}
