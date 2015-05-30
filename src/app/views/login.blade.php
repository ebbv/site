@extends(Config::get('app.theme'))

@section('content')
        <div id="content" class="small-12 medium-4 medium-centered columns">
@if(Session::get('login_error'))
          <div>
            <small class="error">{{ Session::get('login_error') }}</small>
          </div>
@endif
          {{ Form::open(array('url' => 'connexion', 'id' => 'login', 'data-abide')) }}
            <div>
              <label>{{ Lang::get('forms.username') }}
                <input autofocus autocapitalize="none" id="username" name="username" type="text" value="{{ Input::old('username') }}" required />
              </label>
              <small class="error">{{ Lang::get('validation.required') }}</small>
            </div>
            <div>
              <label>{{ Lang::get('forms.password') }}
                <input id="password" name="password" type="password" required />
              </label>
              <small class="error">{{ Lang::get('validation.required') }}</small>
            </div>
            <input name="goto" type="hidden" value="{{ Input::old('goto', $goto) }}" />
            <input class="button right" type="submit" value="{{ Lang::get('forms.login_button') }}" />
          {{ Form::close() }}
@stop
