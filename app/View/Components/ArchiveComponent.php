<?php declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

use App\Models\Post;

class ArchiveComponent extends Component
{
    public $archive;
    public $year;
    public $month;
    public $day;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $year = 0, int $month = 0, int $day = 0)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;

        $query = Post::published()->select('author_id','slug','title','created_at')
                                  ->orderBy('created_at','DESC');

        if ($year > 0) {
            $query = $query->whereYear('created_at', $year);
            if ($month > 0) {
                $query = $query->whereMonth('created_at', $month);
                if ($day > 0) {
                    $query = $query->whereDay('created_at', $day);
                }
            }
        }

        $posts = $query->get();

        $archive = [];
        foreach( $posts as $post ){
            $year  = (int) $post->created_at->format('Y');
            $month = (int) $post->created_at->format('m');
            $day   = (int) $post->created_at->format('d');
            $archive[$year][$month][$day][] = $post;
        }

        $this->archive = $archive;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('components.archive-component');
    }
}
