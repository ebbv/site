<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function __construct(Request $r)
  {
    $this->r = $r;
    $this->middleware('guest', ['only' => 'login']);
  }

  public function login()
  {
    $goto = $this->r->goto;

    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== url('connexion'))
    {
      $goto = $_SERVER['HTTP_REFERER'];
    }

    return view('login')->withGoto($goto);
  }

  public function verify()
  {
    $this->validate($this->r, [
      'username' => 'required',
      'password' => 'required'
    ]);

    if (Auth::attempt(['username'=>$this->r->username, 'password'=>$this->r->password], true))
    {
      DB::table('logins')->insert([
        'member_id' => Auth::id(),
        'time'      => date('Y-m-d H:i:s')
      ]);
      return redirect()->intended($this->r->goto);
    }
    $this->r->session()->flash('login_error', 'Mauvaise combinaison, veuillez réessayer.');
    return back()->withInput($this->r->except('password'));
  }

  public function logout()
  {
    DB::table('logouts')->insert([
      'member_id' => Auth::id(),
      'time'      => date('Y-m-d H:i:s')
    ]);
    Auth::logout();
    return redirect('/');
  }
}
