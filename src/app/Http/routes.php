<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('connexion', array('middleware' => 'guest', function() {
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
      $user = App\Models\Member::find(Auth::id());
      $user->updated_by   = Auth::id();
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


Route::group(array('middleware' => 'auth'), function() {
  Route::group(array('before' => 'admin'), function() {
    Route::get('messages/ajouter', array('as' => 'message.create', function() {
      $files = array();
      foreach((File::glob('../tmp/*.mp3')) ? : array() as $file)
      {
        $files[]= str_replace(array('../tmp/', '.mp3'), '', $file);
      }
      return View::make('messages.create')->withSpeakers(App\Models\Member::has('speaker')->orderBy('last_name', 'asc')->get())->withFiles($files);
    }));

    Route::post('messages', array('as' => 'message.store', function() {
      $filename = str_random(15);
      $data = array(
        'member_id' => Input::get('speaker'),
        'title'     => Input::get('title'),
        'passage'   => Input::get('message-passage'),
        'url'       => $filename,
        'date'      => Input::get('message-file'),
        'created_by'=> Auth::id(),
        'updated_by'=> Auth::id()
      );
      if(App\Models\Message::create($data))
      {
        foreach(array('mp3', 'ogg') as $ext)
        {
          File::move('../tmp/'.Input::get('message-file').'.'.$ext, public_path().'/audio/'.$filename.'.'.$ext);
        }
      }

      return Redirect::route('message.create');
    }));
  });

  Route::get('annuaire', function() {
    return View::make('directory.main')->withMembers(App\Models\Member::with(array('address', 'emails', 'phones' => function($q) {
      $q->orderBy('type', 'asc');
    }))->whereHas('roles', function($q) {
      $q->where('name', 'membre');
    })->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get());
  });

  Route::get('annuaire/ajouter', array('as' => 'directory.create', 'before' => 'admin', function() {
    return View::make('directory.create');
  }));

  Route::get('annuaire/modifier/{id}', array('as' => 'directory.edit', function($id) {
    if(Auth::id() == $id OR App\Models\Member::has('admin')->find(Auth::id()))
    {
      return View::make('directory.edit')->withM(App\Models\Member::find($id));
    }
    else {
      return View::make('errors.no_admin');
    }
  }))->where('id', '[0-9]+');

  Route::post('annuaire', array('as' => 'directory.store', 'before' => 'admin', function() {
    if(Input::get('submit') == 'Ajouter')
    {
      $m = new App\Models\Member;
      $m->first_name  = Input::get('first_name');
      $m->last_name   = Input::get('last_name');
      $m->username    = '';
      $m->password    = '';
      $m->created_by  = Auth::id();
      $m->updated_by  = Auth::id();
      $m->save();

      $m->roles()->attach(2, array(
        'created_by' => Auth::id(),
        'updated_by' => Auth::id()
      ));

      $m->address()->save(new App\Models\Address(array(
        'street_number'     => Input::get('street_number'),
        'street_type'       => Input::get('street_type'),
        'street_name'       => Input::get('street_name'),
        'street_complement' => Input::get('street_complement'),
        'zip'               => Input::get('zip'),
        'city'              => Input::get('city'),
        'created_by'        => Auth::id(),
        'updated_by'        => Auth::id()
      )));

      foreach(Input::get('telephone') as $type => $number)
      {
        if($number != '')
        {
          $m->phones()->save(new App\Models\Phone(array(
            'number'        => $number,
            'type'          => ucfirst($type),
            'created_by'    => Auth::id(),
            'updated_by'    => Auth::id()
          )));
        }
      }

      foreach(Input::get('emails') as $key => $address)
      {
        if($address != '')
        {
          $m->emails()->save(new App\Models\Email(array(
            'address'       => $address,
            'type'          => $key,
            'created_by'    => Auth::id(),
            'updated_by'    => Auth::id()
          )));
        }
      }
    }
    else {
      $id = Input::get('id');
      $m = App\Models\Member::find($id);
      $m->first_name  = Input::get('first_name');
      $m->last_name   = Input::get('last_name');
      $m->updated_by  = Auth::id();
      $m->save();

      App\Models\Address::where('member_id', $id)->update(array(
        'street_number'     => Input::get('street_number'),
        'street_type'       => Input::get('street_type'),
        'street_name'       => Input::get('street_name'),
        'street_complement' => Input::get('street_complement'),
        'zip'               => Input::get('zip'),
        'city'              => Input::get('city'),
        'updated_by'        => Auth::id()
      ));

      foreach(Input::get('telephone') as $type => $number)
      {
        $type = ucfirst($type);
        if($number != '')
        {
          if( ! App\Models\Phone::where('member_id', $id)->where('type', $type)->update(array(
            'number'      => $number,
            'updated_by'  => Auth::id()
          )))
          {
            $m->phones()->save(new App\Models\Phone(array(
              'number'        => $number,
              'type'          => $type,
              'created_by'    => Auth::id(),
              'updated_by'    => Auth::id()
            )));
          }
        }
        elseif($number == '')
        {
          App\Models\Phone::where('member_id', $id)->where('type', $type)->delete();
        }
      }

      foreach(Input::get('emails') as $key => $address)
      {
        if($address != '')
        {
          if( ! App\Models\Email::where('member_id', $id)->where('type', $key)->update(array(
            'address'   => $address,
            'updated_by'=> Auth::id()
          )))
          {
            $m->emails()->save(new App\Models\Email(array(
              'address'   => $address,
              'type'      => $key,
              'created_by'=> Auth::id(),
              'updated_by'=> Auth::id()
            )));
          }
        }
        elseif($address == '')
        {
          App\Models\Email::where('member_id', $id)->where('type', $key)->delete();
        }
      }
    }

    return Redirect::route('directory.create');
  }));
});

Route::get('/', function() {
  $messages = App\Models\Message::with('speaker')->orderBy('date', 'desc')->orderBy('created_at', 'desc')->paginate(4);
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

Route::post('deploy', function() {
  $local = 'sha1='.hash_hmac('sha1', file_get_contents('php://input'), env('APP_WEBHOOK_KEY'));
  if($local === $_SERVER['HTTP_X_HUB_SIGNATURE'])
  {
    shell_exec('git pull');
    return shell_exec('gulp');
  }
  else {
    return 'Signatures do not match';
  }
});


View::creator(Config::get('app.theme'), function($view) {
  $view->with('theme', str_replace('master', '', Config::get('app.theme')));
});
