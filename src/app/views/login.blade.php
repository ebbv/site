@extends(Config::get('app.theme'))

@section('content')
                <div id="content" class="small-12 medium-4 medium-centered columns">
                    {{ Form::open(array('url' => 'connexion.html', 'id' => 'contact')) }}
                        <div>
                            <small <?php if(Session::get('login_error')) echo 'class="error"'; ?>>{{ Session::get('login_error') }}</small>
                        </div>
                        <label>Nom d'utilisateur
                            <input autofocus id="username" name="username" type="text" value="{{ Input::old('username') }}" />
                        </label>
                        <div>
                            <small <?php if($errors->has('username')) echo 'class="error"'; ?>>{{ $errors->first('username') }}</small>
                        </div>
                        <label>Mot de passe
                            <input id="password" name="password" type="password" />
                        </label>
                        <div>
                            <small <?php if($errors->has('password')) echo 'class="error"'; ?>>{{ $errors->first('password') }}</small>
                        </div>
                        <input name="goto" type="hidden" value="{{ Input::old('goto', $goto) }}" />
                        <input type="submit" value="Se connecter" />
                    {{ Form::close() }}
@stop
