<?php

namespace App\View\Components\Contact;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactForm extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.contact.contact-form');
    }
}
