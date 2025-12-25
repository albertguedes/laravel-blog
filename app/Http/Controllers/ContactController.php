<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests\Contact\MessageRequest;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function send (MessageRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            Mail::to([env('MAIL_TO_ADDRESS'), $validated['email']])
                    ->send(new ContactMessage($validated));

            return redirect()
                ->route('contact')
                ->with('success', 'Message sent successfully.');
        } catch (TransportExceptionInterface $e) {
            return redirect()
                ->route('contact')
                ->with('error', 'Failed to send message: ' . $e->getMessage());
        }
    }
}
