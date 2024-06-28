<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class ArchiveComponent extends Component
{

    public $archive;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        $posts = Post::Published()->select('author_id','slug','title','created_at')
                     ->orderBy('created_at','DESC')
                     ->get();

        $archive = [];
        foreach( $posts as $post ){
            $year  = $post->created_at->format('Y');
            $month = $post->created_at->format('F');
            $day   = $post->created_at->format('d');
            $archive[$year][$month][$day][] = $post;
        }

        $this->archive = $archive;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.archive-component');
    }
}
