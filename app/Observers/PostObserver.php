<?php declare(strict_types=1);

namespace App\Observers;

use App\Jobs\IndexPost;
use App\Models\Post;

class PostObserver
{
    public function saved(Post $post)
    {
        IndexPost::dispatch($post);
    }
}
