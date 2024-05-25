<?php

namespace App\Http\Controllers;

use App\Jobs\UserSendMailJob;
use App\Mail\UserMessageToAdmin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Exception;
use Symfony\Component\Mailer\Exception\UnexpectedResponseException;

class ContactController extends Controller
{

    public function showContactForm()
    {
        return view('user.components.contact-us');
    }

    public function sendFromUser(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email',
                'message' => 'required|string'
            ]);
            $data['name'] = $request->user()->first_name;
            $data['subject']='User Message To Admin';
            UserSendMailJob::dispatch($data);
            return redirect('home')->with('success', 'Your message has been sent successfully!');
        }catch ( UnexpectedResponseException){
            return redirect('home')->with('error','You provide wrong email address.');
        }catch (Exception){
            return redirect('home')->with('error','Your message does not sent.');
        }
    }
}
