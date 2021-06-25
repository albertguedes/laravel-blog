<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{

    public function index(){
        return view('contact');
    }

    public function sendmessage( Request $request ){

        $message = $request->get('message');

        try { 
            $ContactMessage = new ContactMessage($message);
            Mail::to(env('MAIL_TO_ADDRESS'))->send($ContactMessage);
            return redirect()->route('contact')->with('success','Message sended with success!');
        }
        catch( \Exception $e ){
            return redirect()->route('contact')->with('danger','Error on send message. Try again later.');
        }

    }

}
