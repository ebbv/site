<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
  public function index()
  {
    return view('contact');
  }

  public function send(Request $request)
  {
    $rules = array(
      'email' => 'required|email'
    );
    $v = Validator::make($request->all(), $rules);
    if($v->passes())
    {
      Mail::send('emails.contact', $request->all(), function($message) {
        $message->to('pasteur@ebbv.fr')->subject('Message du site de l\'église');
      });
      return view('emails.sent');
    }
    return Redirect::to('contact')->withErrors($v);
  }
}
