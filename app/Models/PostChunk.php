<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Post content chunk model for RAG embeddings.
 *
 * Stores pre-processed chunks of post content along with their
 * vector embeddings for AI-powered search and问答 functionality.
 *
 * @property int $id
 * @property int $post_id
 * @property string $content
 * @property array $embedding
 */
class PostChunk extends Model
{
    /** @var bool Disable timestamps */
    public $timestamps = false;

    /** @var array<string> Fillable attributes */
    protected $fillable = [
        'post_id',
        'content',
        'embedding',
    ];
}
