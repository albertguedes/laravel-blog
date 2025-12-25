<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'description',
        'content',
        'published',
    ];

    protected function casts() {
        return [
            'author_id' => 'integer',
            'category_id' => 'integer',
            'title' => 'string',
            'slug' => 'string',
            'description' => 'string',
            'content' => 'string',
            'published' => 'boolean',
        ];
    }

    /**
     * Boot the model.
     *
     * Set the slug of the post using the title when creating or updating.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function ($post) {
            $source = $post->slug ?: $post->title;
            $post->slug = Str::slug($source);
        });

        static::updating(function ($post) {
            if ($post->isDirty(['title', 'slug'])) {
                $source = $post->slug ?: $post->title;
                $post->slug = Str::slug($source);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)
                    ->withPivot('created_at');
    }
}
