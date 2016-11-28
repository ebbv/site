<?php

namespace App\Http\Controllers;

class BeliefsController extends Controller
{
  public function __construct()
  {

  }

  public function index()
  {
    return view('beliefs.main');
  }
}
