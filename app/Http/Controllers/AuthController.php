<?php

/**
 * Authentication Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

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

    /**
     * 
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login')->withGoto((filter_input(INPUT_SERVER, 'HTTP_REFERER')) ? : $this->r->goto);
    }

    /**
     * 
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify()
    {
        $this->validate($this->r, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username'=>$this->r->username, 'password'=>$this->r->password], true)) {
            DB::table('logins')->insert([
                'member_id' => Auth::id(),
                'time'      => date('Y-m-d H:i:s')
            ]);

            return redirect()->intended($this->r->goto);
        }

        $this->r->session()->flash('login_error', 'Mauvaise combinaison, veuillez réessayer.');

        return back()->withInput($this->r->except('password'));
    }

    /**
     * 
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\RedirectResponse
     */
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
