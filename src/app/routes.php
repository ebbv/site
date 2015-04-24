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

Route::get('connexion', array('before'=>'guest', function() {
    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== Request::root().'/connexion')
    {
        $goto = $_SERVER['HTTP_REFERER'];
    }
    else {
        $goto = Input::get('goto');
    }

    return View::make('login')->withGoto($goto);
}));

Route::post('connexion', function() {
    $rules = array('username'=>'required', 'password'=>'required');
    $v = Validator::make(Input::all(), $rules);
    if ($v->passes())
    {
        if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password'))))
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
    return Redirect::to('connexion')->withInput(Input::except('password'))->withErrors($v);
});

Route::get('déconnexion', function() {
    Auth::logout();
    return Redirect::to('/');
});


Route::group(array('before'=>'auth'), function() {
    Route::get('messages/ajouter', array('as' => 'message.create', function() {
        $files = array();
        foreach((File::glob('../tmp/*.mp3')) ? : array() as $file)
        {
            $files[]= str_replace(array('../tmp/', '.mp3'), '', $file);
        }
        return View::make('messages.create')->withSpeakers(Member::has('speaker')->orderBy('last_name', 'asc')->get())->withFiles($files);
    }));

    Route::post('messages', array('as' => 'message.store', function() {
        $filename = Str::random(15);
        $data = array(
            'member_id' => Input::get('speaker'),
            'title'     => Input::get('title'),
            'passage'   => Input::get('message-passage'),
            'url'       => $filename,
            'date'      => Input::get('message-file'),
            'created_by'=> Auth::user()->id,
            'updated_by'=> Auth::user()->id
        );
        if(Message::create($data))
        {
            foreach(array('mp3', 'ogg') as $ext)
            {
                File::move('../tmp/'.Input::get('message-file').'.'.$ext, public_path().'/audio/'.$filename.'.'.$ext);
            }
        }

        return Redirect::route('message.create');
    }));

    Route::get('annuaire', function() {
        return View::make('members.main')->withMembers(Member::with(array('address', 'emails', 'phones' => function($q) {
            $q->orderBy('type', 'asc');
        }))->whereHas('roles', function($q) {
            $q->where('name', '=', 'membre');
        })->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get());
    });

    Route::get('members/ajouter', array('as' => 'members.create', function() {
        return View::make('members.create');
    }));

    Route::post('members', array('as' => 'members.store', function() {
        $m = new Member;
        $m->first_name  = Input::get('first_name');
        $m->last_name   = Input::get('last_name');
        $m->username    = '';
        $m->password    = '';
        $m->created_by  = Auth::user()->id;
        $m->updated_by  = Auth::user()->id;
        $m->save();
        $insertedId = $m->id;
        $m->roles()->attach(2, array(
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id
        ));
        
        $a = new Address;
        $a->member_id        = $insertedId;
        $a->street_number    = Input::get('street_number');
        $a->street_type      = Input::get('street_type');
        $a->street_name      = Input::get('street_name');
        $a->street_complement= Input::get('street_complement');
        $a->zip              = Input::get('zip');
        $a->city             = Input::get('city');
        $a->created_by       = Auth::user()->id;
        $a->updated_by       = Auth::user()->id;
        $a->save();

        $p1 = new Phone;
        $p1->member_id  = $insertedId;
        $p1->number     = Input::get('fixe');
        $p1->type       = 'Fixe';
        $p1->created_by = Auth::user()->id;
        $p1->updated_by = Auth::user()->id;
        $p1->save();

        $p2 = new Phone;
        $p2->member_id  = $insertedId;
        $p2->number     = Input::get('port');
        $p2->type       = 'Port';
        $p2->created_by = Auth::user()->id;
        $p2->updated_by = Auth::user()->id;
        $p2->save();

        foreach(Input::get('email') as $address)
        {
            if($address != '')
            {
                $e = new Email;
                $e->member_id   = $insertedId;
                $e->address     = $address;
                $e->type        = '';
                $e->created_by  = Auth::user()->id;
                $e->updated_by  = Auth::user()->id;
                $e->save();
            }
        }

        return Redirect::route('members.create');
    }));
});

Route::get('/', function() {
    $messages = Message::with('speaker')->orderBy('date', 'desc')->orderBy('created_at', 'desc')->paginate(4);
    return View::make('messages.main')->withMessages($messages);
});

Route::get('contact', function() {
    return View::make('contact');
});

Route::post('contact', function() {
    $rules = array(
        'email' => 'required|email'
    );
    $v = Validator::make(Input::all(), $rules);
    if($v->passes())
    {
        Mail::send('emails.contact', Input::all(), function($message) {
            $message->to('pasteur@ebbv.fr')->subject('Message du site de l\'église');
        });
        return View::make('emails.sent');
    }
    return Redirect::to('contact')->withErrors($v);
});


View::creator(Config::get('app.theme'), function($view) {
    $view->with('theme', str_replace('master', '', Config::get('app.theme')));
});
