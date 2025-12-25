<?php declare(strict_types=1);

namespace App\View\Components\Archive;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class ArchiveTitleComponent extends Component
{
    public array $items;

    /**
     * Create a new component instance.
     */
    public function __construct (int $year, int $month = 0, int $day = 0)
    {
        $this->items = [
            'archive' => [
                'route' => route('archive'),
                'label' => '',
                'icon' => 'fa fa-calendar',
                'active' => true
            ],

            'year' => [
                'route' => route('archive', compact('year')),
                'label' => $year,
                'icon' => null,
                'active' => $year > 0 ? true : false
            ],

            'month' => [
                'route' => route('archive', compact('year', 'month')),
                'label' => Carbon::create(1,$month,1)->format('M'),
                'icon' => null,
                'active' => $month > 0 ? true : false
            ],

            'day' => [
                'route' => '',
                'label' => $day,
                'icon' => null,
                'active' => $day > 0 ? true : false
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.archive.archive-title-component');
    }
}
