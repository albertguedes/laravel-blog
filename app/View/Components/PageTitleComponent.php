<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Component for rendering a page title with optional icon.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class PageTitleComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title, public string $icon = '') {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-title-component');
    }
}
