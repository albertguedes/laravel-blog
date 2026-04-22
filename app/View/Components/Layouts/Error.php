<?php

declare(strict_types=1);

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Error page layout component.
 *
 * Provides the HTML structure for error pages (404, 500, etc.).
 * Features a centered error message display with navigation options.
 */
class Error extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  string  $title  Error title (e.g., "404 Not Found")
     * @param  string  $description  Error description for SEO
     * @param  string  $styles  Additional CSS styles to inject
     * @param  string  $scripts  Additional JavaScript to inject in head
     * @param  string  $footer_scripts  Additional JavaScript to inject before </body>
     */
    public function __construct(
        public string $title = '',
        public string $description = '',
        public string $styles = '',
        public string $scripts = '',
        public string $footer_scripts = ''
    ) {}

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.error');
    }
}
