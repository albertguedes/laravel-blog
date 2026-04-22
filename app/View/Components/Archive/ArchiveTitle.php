<?php

declare(strict_types=1);

namespace App\View\Components\Archive;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

/**
 * Archive navigation title component.
 *
 * Renders breadcrumb-style navigation for archive pages showing
 * year, month, and day links when filtering by date.
 */
class ArchiveTitle extends Component
{
    /** @var array<string, array{route: string|null, label: string, icon: string|null, active: bool}> Navigation items */
    public array $items;

    /**
     * Create a new component instance.
     *
     * @param  int  $year  Year to display
     * @param  int  $month  Month to display (0 for none)
     * @param  int  $day  Day to display (0 for none)
     */
    public function __construct(int $year, int $month = 0, int $day = 0)
    {
        $this->items = [
            'archive' => [
                'route' => route('archive'),
                'label' => '',
                'icon' => 'fa fa-calendar',
                'active' => true,
            ],

            'year' => [
                'route' => route('archive', compact('year')),
                'label' => $year,
                'icon' => null,
                'active' => $year > 0 ? true : false,
            ],

            'month' => [
                'route' => route('archive', compact('year', 'month')),
                'label' => Carbon::create(1, $month, 1)->format('M'),
                'icon' => null,
                'active' => $month > 0 ? true : false,
            ],

            'day' => [
                'route' => '',
                'label' => $day,
                'icon' => null,
                'active' => $day > 0 ? true : false,
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.archive.archive-title');
    }
}
