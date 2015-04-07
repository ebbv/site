@extends(Config::get('app.theme'))

@section('content')
                <div id="content" class="small-12 medium-4 medium-centered columns">
@if(Session::get('login_error'))
                    <div>
                        <small class="error">{{ Session::get('login_error') }}</small>
                    </div>
@endif
                    {{ Form::open(array('url' => 'connexion.html', 'id' => 'login', 'data-abide')) }}
                        <div>
                            <label>Nom d'utilisateur
                                <input autofocus id="username" name="username" type="text" value="{{ Input::old('username') }}" required />
                            </label>
                            <small class="error">Obligatoire</small>
                        </div>
                        <div>
                            <label>Mot de passe
                                <input id="password" name="password" type="password" required />
                            </label>
                            <small class="error">Obligatoire</small>
                        </div>
                        <input name="goto" type="hidden" value="{{ Input::old('goto', $goto) }}" />
                        <input type="submit" value="Se connecter" />
                    {{ Form::close() }}
@stop
