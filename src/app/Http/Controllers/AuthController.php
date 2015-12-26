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

  public function login(Request $request)
  {
    $goto = $request->goto;

    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== url('connexion'))
    {
      $goto = $_SERVER['HTTP_REFERER'];
    }

    return view('login')->withGoto($goto);
  }

  public function verify(Request $request)
  {
    $rules = array('username'=>'required', 'password'=>'required');
    $v = Validator::make($request->all(), $rules);
    if ($v->passes())
    {
      if (Auth::attempt(array('username'=>$request->username, 'password'=>$request->password)))
      {
        $user = Member::find(Auth::id());
        $user->updated_by   = Auth::id();
        $user->last_login   = Auth::user()->current_login;
        $user->current_login= date('Y-m-d H:i:s');
        $user->save();
        return redirect()->intended($request->goto);
      }
      $request->session()->flash('login_error', 'Mauvaise combinaison, veuillez réessayer.');
    }
    return redirect('connexion')->withInput($request->except('password'))->withErrors($v);
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/');
  }
}
