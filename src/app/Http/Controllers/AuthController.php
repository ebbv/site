<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Member;

class AuthController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest', ['only' => 'login']);
  }

  public function login(Request $r)
  {
    $goto = $r->goto;

    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== url('connexion'))
    {
      $goto = $_SERVER['HTTP_REFERER'];
    }

    return view('login')->withGoto($goto);
  }

  public function verify(Request $r)
  {
    $rules = array('username'=>'required', 'password'=>'required');
    $v = Validator::make($r->all(), $rules);
    if ($v->passes())
    {
      if (Auth::attempt(array('username'=>$r->username, 'password'=>$r->password)))
      {
        $u = Member::find(Auth::id());
        $u->updated_by   = Auth::id();
        $u->last_login   = Auth::user()->current_login;
        $u->current_login= date('Y-m-d H:i:s');
        $u->save();
        return redirect()->intended($r->goto);
      }
      $r->session()->flash('login_error', 'Mauvaise combinaison, veuillez réessayer.');
    }
    return redirect('connexion')->withInput($r->except('password'))->withErrors($v);
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/');
  }
}
