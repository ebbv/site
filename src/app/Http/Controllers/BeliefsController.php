<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;

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
