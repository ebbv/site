<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Validator;
use App\Http\Requests;

class ContactController extends Controller
{
  public function index()
  {
    return view('contact');
  }

  public function send(Request $r)
  {
    $rules = [
      'email' => 'required|email'
    ];
    $v = Validator::make($r->all(), $rules);
    if($v->passes())
    {
      Mail::send('emails.contact', $r->all(), function($message) {
        $message->to('pasteur@ebbv.fr')->subject('Message du site de l\'église');
      });
      return view('emails.sent');
    }
    return redirect('contact')->withErrors($v);
  }
}
