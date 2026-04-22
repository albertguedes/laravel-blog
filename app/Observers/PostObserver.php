<?php

declare(strict_types=1);

namespace App\Observers;

use App\Jobs\IndexPost;
use App\Models\Post;

/**
 * Post model observer.
 *
 * Listens to Post model events and dispatches jobs for post indexing.
 * When a post is created or updated, dispatches IndexPost job to
 * generate embeddings for the RAG search system.
 */
class PostObserver
{
    /**
     * Handle the Post saved event.
     *
     * Called when a post is created or updated. Dispatches the IndexPost
     * job to create/update embeddings for AI-powered search.
     *
     * @param  Post  $post  The post that was saved
     */
    public function saved(Post $post): void
    {
        IndexPost::dispatch($post);
    }
}
