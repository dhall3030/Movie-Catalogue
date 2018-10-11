<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function send(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message) use ($title)
        {

            $message->from('dorian.hall@gmail.com', 'Dorian Hall');

            $message->subject($title);

            $message->to('dorian@selfip.net');

        });


        return response()->json(['message' => 'Request completed']);
    }
}
