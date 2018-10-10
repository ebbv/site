<?php

/**
 * Beliefs Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Http\Controllers;

class BeliefsController extends Controller
{
    /**
     * The main beliefs page
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('beliefs.index');
    }
}
