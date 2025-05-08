<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function sendMessage (Request $request): RedirectResponse
    {
        $message = $request->get('message');

        try {
            $ContactMessage = new ContactMessage($message);
            Mail::to(env('MAIL_TO_ADDRESS'))->send($ContactMessage);
            return redirect()->route('contact')
                             ->with('success','Message sended with success!');
        }
        catch( \Exception $e ){
            return redirect()->route('contact')
                             ->with('danger','Error on send message. Try again later.');
        }
    }
}
