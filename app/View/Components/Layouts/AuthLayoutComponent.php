<?php declare(strict_types=1);

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthLayoutComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title = '',
        public string $description = '',
        public string $styles = '',
        public string $scripts = '',
        public string $footer_scripts = ''
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.auth-layout-component');
    }
}
