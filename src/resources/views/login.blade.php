@extends(Config::get('app.theme'))

@section('content')
        <div id="content" class="small-12 medium-4 medium-centered columns">
@if(Session::get('login_error'))
          <div>
            <small class="error">{{ Session::get('login_error') }}</small>
          </div>
@endif
          <form method="POST" action="connexion" accept-charset="utf-8" id="login" data-abide>
            {!! csrf_field() !!}
            <div>
              <label>{{ Lang::get('forms.username') }}
                <input autofocus autocapitalize="none" id="username" name="username" type="text" value="{{ Input::old('username') }}" required />
                <small class="form-error">{{ Lang::get('validation.required') }}</small>
              </label>
            </div>
            <div>
              <label>{{ Lang::get('forms.password') }}
                <input id="password" name="password" type="password" required />
                <small class="form-error">{{ Lang::get('validation.required') }}</small>
              </label>
            </div>
            <input name="goto" type="hidden" value="{{ Input::old('goto', $goto) }}" />
            <button class="button float-right" type="submit" value="{{ Lang::get('forms.login_button') }}">{{ Lang::get('forms.login_button') }}</button>
          </form>
@stop
