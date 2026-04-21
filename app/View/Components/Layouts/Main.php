<?php

declare(strict_types=1);

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Main extends Component
{
    public function __construct(
        public string $title = '',
        public string $description = '',
        public string $styles = '',
        public string $scripts = '',
        public string $footer_scripts = ''
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.layouts.main');
    }
}
