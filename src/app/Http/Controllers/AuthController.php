<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
    $rules = ['username'=>'required', 'password'=>'required'];
    $v = Validator::make($this->r->all(), $rules);
    if ($v->passes())
    {
      if (Auth::attempt(['username'=>$this->r->username, 'password'=>$this->r->password], true))
      {
        DB::table('logins')->insert([
          'member_id' => Auth::id(),
          'time'      => date('Y-m-d H:i:s')
        ]);
        return redirect()->intended($this->r->goto);
      }
      $this->r->session()->flash('login_error', 'Mauvaise combinaison, veuillez réessayer.');
    }
    return redirect('connexion')->withInput($this->r->except('password'))->withErrors($v);
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
