<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class TagCloud extends Component
{
    public $tags = [];

    protected const MIN_FONT_SIZE = 15;

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

    private static function calculateFontSize(int $nPosts): int
    {
        return (int) (self::MIN_FONT_SIZE * (1 + 2 * $nPosts / 100));
    }

    public function render(): View|\Closure|string
    {
        return view('components.common.tag-cloud');
    }
}
