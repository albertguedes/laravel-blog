<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Contact\MessageRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

/**
 * Controller for contact form functionality.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class ContactController extends Controller
{
    /**
     * Display the contact form.
     *
     * @return View
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Send the contact message.
     */
    public function send(MessageRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            Mail::to([env('MAIL_TO_ADDRESS'), $validated['email']])
                ->send(new ContactMessage($validated));

            return redirect()->route('contact')
                ->with('success', 'Message sent successfully.');
        } catch (TransportExceptionInterface $e) {
            return redirect()->route('contact')
                ->with('danger', 'Failed to send message: '.$e->getMessage());
        }
    }
}
