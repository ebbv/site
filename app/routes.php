<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('connexion.html', array('before'=>'guest', function()
{
    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== Request::root().'/connexion.html')
    {
        $goto = $_SERVER['HTTP_REFERER'];
    }
    else {
        $goto = Input::get('goto');
    }

    return View::make('login')->with('goto', $goto);
}));

Route::post('connexion.html', function()
{
    $rules = array('username'=>'required', 'password'=>'required');
    $v = Validator::make(Input::all(), $rules);
    if ($v->passes())
    {
        if (Auth::attempt(array('email'=>Input::get('username'), 'password'=>Input::get('password'))))
        {
            $user = Member::find(Auth::user()->id);
            $user->updated_by   = Auth::user()->id;
            $user->last_login   = Auth::user()->current_login;
            $user->current_login= date('Y-m-d H:i:s');
            $user->save();
            return Redirect::intended(Input::get('goto'));
        }
        Session::flash('login_error', 'Mauvaise combinaison, veuillez réessayer.');
    }
    return Redirect::to('connexion.html')->withInput(Input::except('password'))->withErrors($v);
});

Route::get('déconnexion.html', function()
{
    Auth::logout();
    return Redirect::to('/');
});


Route::group(array('before'=>'auth'), function()
{
    Route::get('messages/ajouter.html', array('as' => 'message.create', function()
    {
        $files = array();
        foreach((File::glob('../tmp/*.mp3')) ? : array() as $file)
        {
            $files[]= trim($file, '\.\.\/tmp\.mp3');
        }
        return View::make('messages.create')->with('speakers', Member::has('speaker')->get())->withFiles($files);
    }));

    Route::post('messages.html', array('as' => 'message.store', function()
    {
        $filename = Str::random(15);
        $message = new Message;
        $message->member_id = Input::get('speaker');
        $message->title     = Input::get('title');
        $message->passage   = Input::get('message-passage');
        $message->url       = $filename;
        $message->date      = Input::get('message-file');
        $message->created_by= Auth::user()->id;
        $message->updated_by= Auth::user()->id;
        if($message->save())
        {
            foreach(array('mp3', 'ogg', 'wav') as $ext)
            {
                File::move('../tmp/'.Input::get('message-file').'.'.$ext, public_path().'/audio/'.$filename.'.'.$ext);
            }
        }

        return Redirect::route('message.create');
    }));
});

Route::get('/', function() {
    return View::make('messages.main')->with('messages', Message::with('speaker')->orderBy('date', 'desc')->get());
});


View::creator(Config::get('app.theme'), function($view)
{
    $view->with('theme', str_replace('master', '', Config::get('app.theme')));
});