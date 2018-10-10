<?php

/**
 * Contact Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Http\Controllers;

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
}
