<?php

/**
 * Home Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Http\Controllers;

class HomeController extends Controller
{

    /**
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->route('messages.index');
    }
}
