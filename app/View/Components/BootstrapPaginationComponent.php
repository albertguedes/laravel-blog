<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BootstrapPaginationComponent extends Component
{
    public function __construct(
        public LengthAwarePaginator $paginator,
        public string $alignment = 'center'
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.bootstrap-pagination-component');
    }
}
