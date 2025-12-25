<?php declare(strict_types=1);

namespace App\View\Components\Posts;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Post;

class ArchiveComponent extends Component
{
    public array $archive = [];
    public LengthAwarePaginator $paginate;
    public int $current_year = 0;
    public int $current_month = 0;
    public int $current_day = 0;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $year = 0, int $month = 0, int $day = 0)
    {
        $this->current_year = $year;
        $this->current_month = $month;
        $this->current_day = $day;


        $query = Post::where('published', true)
                        ->orderBy('created_at', 'desc');

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

        foreach($posts as $post) {
            $this->archive[$post->created_at->year][$post->created_at->month][$post->created_at->day] = 1;
        }

        // If was day page, paginate
        $this->paginate = new LengthAwarePaginator([], 1, 9);
        if ($day > 0) {
            $this->paginate = $query->paginate(9)->withQueryString();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('components.posts.archive-component');
    }
}
