<?php

declare(strict_types=1);

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Authentication layout component.
 *
 * Provides the HTML structure for authentication pages (login, register, password reset).
 * Features a centered card layout with branding.
 */
class Auth extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  string  $title  Page title for browser tab and header
     * @param  string  $description  Meta description for SEO
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
        return view('components.layouts.auth');
    }
}
