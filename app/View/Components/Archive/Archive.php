<?php

declare(strict_types=1);

namespace App\View\Components\Archive;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class Archive extends Component
{
    public array $archive = [];

    public LengthAwarePaginator $paginate;

    public int $current_year = 0;

    public int $current_month = 0;

    public int $current_day = 0;

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

        foreach ($posts as $post) {
            $this->archive[$post->created_at->year][$post->created_at->month][$post->created_at->day] = 1;
        }

        $this->paginate = new LengthAwarePaginator([], 1, 9);
        if ($day > 0) {
            $this->paginate = $query->paginate(9)->withQueryString();
        }
    }

    public function render(): View
    {
        return view('components.archive.archive');
    }
}
