<?php

/**
 * Errors Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Http\Controllers;

class ErrorsController extends Controller
{
    /**
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('errors.no_admin');
    }
}
