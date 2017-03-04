<?php

namespace App\Http\Controllers;

class ErrorsController extends Controller
{
    public function index()
    {
        return view('errors.no_admin');
    }
}
