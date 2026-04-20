<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JsonLdSchemaComponent extends Component
{
    public function __construct(
        public string $type = 'WebSite',
        public array $author = []
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.json-ld-schema-component');
    }
}
