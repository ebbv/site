<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function index()
  {
    return view('contact');
  }

  public function send(Request $r)
  {
    $this->validate($r, [
      'email' => 'required|email'
    ]);

    Mail::send('emails.contact', $r->all(), function($message) {
      $message->to('pasteur@ebbv.fr')->subject('Message du site de l\'église');
    });
    return view('emails.sent');
  }
}
