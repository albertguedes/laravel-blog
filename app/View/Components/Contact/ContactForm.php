<?php

namespace App\View\Components\Contact;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Contact form component.
 *
 * Renders a contact form with fields for name, email, and message.
 * Handles validation and submission via the contact controller.
 */
class ContactForm extends Component
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
        return view('components.contact.contact-form');
    }
}
