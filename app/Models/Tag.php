<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Tag model for labeling posts.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'is_active' => 'boolean',
    ];

    /**
     * Get the route key name for URL resolution.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the posts with this tag.
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class)
            ->withPivot('created_at');
    }
}
