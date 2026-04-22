<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Post-Tag pivot model.
 *
 * Represents the many-to-many relationship between posts and tags.
 * Uses composite primary key (post_id, tag_id).
 *
 * @property int $post_id
 * @property int $tag_id
 */
class PostTag extends Model
{
    /** @var bool Disable auto-incrementing IDs */
    public $incrementing = false;

    /** @var array<int> Composite primary key */
    protected $primaryKey = ['post_id', 'tag_id'];

    /** @var string Key type */
    protected $keyType = 'int';

    /** @var bool Disable timestamps (pivot table) */
    public $timestamps = false;

    /**
     * Get the post for this pivot entry.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the tag for this pivot entry.
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
