<?php

declare(strict_types=1);

namespace App\View\Components\Tags;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

/**
 * Tag cloud display component.
 *
 * Renders a cloud of all active tags with font sizes scaled by post count.
 * Tags with more posts appear larger in the cloud.
 */
class TagCloud extends Component
{
    /** @var array<int, array{id: int, title: string, slug: string, n_posts: int, font_size: string}> Tag items */
    public $tags = [];

    /** @var int Minimum font size in pixels */
    protected const MIN_FONT_SIZE = 15;

    /**
     * Create a new component instance.
     *
     * @param  Collection  $tags  Collection of Tag models
     */
    public function __construct(Collection $tags)
    {
        foreach ($tags as $tag) {

            $nPosts = $tag->posts()->where('published', true)->count();

            $this->tags[] = [
                'id' => $tag->id,
                'title' => $tag->title,
                'slug' => $tag->slug,
                'n_posts' => $tag->posts()->where('published', true)->count(),
                'font_size' => 'style=font-size:'.self::calculateFontSize($nPosts).'px;',
            ];
        }
    }

    /**
     * Calculate font size based on post count.
     *
     * @param  int  $nPosts  Number of posts for the tag
     * @return int Font size in pixels
     */
    private static function calculateFontSize(int $nPosts): int
    {
        return (int) (self::MIN_FONT_SIZE * (1 + 2 * $nPosts / 100));
    }

    /**
     * Get the view / view contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|\Closure|string
    {
        return view('components.tags.tag-cloud');
    }
}
