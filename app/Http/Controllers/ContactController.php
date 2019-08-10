<?php

/**
 * Contact Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;

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
        return view('contact.index');
    }

    public function send()
    {
        Mail::to('pasteur@ebbv.fr')->send(new ContactForm());

        return view('contact.thankYou');
    }
}
