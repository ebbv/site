@extends(Config::get('app.theme'))

@section('content')
                <div>
                    <span>{{ Session::get('login_error') }}</span>
                    {{ Form::open(array('url' => 'connexion.html'))."\n" }}
                        <strong>{{ $errors->first('username') }}</strong>
                        <label for="username">Nom d'utilisateur</label>
                        <input id="username" name="username" type="text" value="{{ Input::old('username') }}">
                        <strong>{{ $errors->first('password') }}</strong>
                        <label for="password">Mot de passe</label>
                        <input id="password" name="password" type="password">
                        <input name="goto" type="hidden" value="{{ Input::old('goto', $goto) }}">
                        <input type="submit" value="Se connecter">
                    {{ Form::close()."\n" }}
                </div>
@stop
