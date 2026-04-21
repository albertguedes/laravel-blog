<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Component for a send/submit button.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class SendButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.common.send-button');
    }
}
