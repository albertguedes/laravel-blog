<?php

declare(strict_types=1);

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Email layout component.
 *
 * Provides the HTML structure for transactional emails sent by the application.
 * Features a clean, minimal design optimized for email client compatibility.
 */
class Mail extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.mail');
    }
}
