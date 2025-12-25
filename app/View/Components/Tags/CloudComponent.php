<?php declare(strict_types=1);

namespace App\View\Components\Tags;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class CloudComponent extends Component
{
    public $tags = [];

    protected const MIN_FONT_SIZE = 15;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $tags)
    {
        foreach ($tags as $tag) {
            $this->tags[] = [
                'id' => $tag->id,
                'title' => $tag->title,
                'slug' => $tag->slug,
                'n_posts' => $tag->posts()->where('published',true)->count(),
                'font_size' => 'style=font-size:' . (self::MIN_FONT_SIZE + 2*$tag->posts->count()) . 'px;',
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tags.cloud-component');
    }
}
