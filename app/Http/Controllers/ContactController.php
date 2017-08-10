<?php

/**
 * Contact Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * The main contact page
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Handling the sending of an email from the contact form
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \Illuminate\Http\Request $r
     * @return \Illuminate\Http\Response
     */
    public function send(Request $r)
    {
        $this->validate($r, [
            'email' => 'required|email'
        ]);

        Mail::send('emails.contact', $r->all(), function ($message) {
            $message->to('pasteur@ebbv.fr')->subject('Message du site de l\'église');
        });

        return view('emails.sent');
    }
}
