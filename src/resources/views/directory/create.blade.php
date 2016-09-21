@extends(Config::get('app.theme'))

@section('content')
        <div id="content" class="small-12 columns">
          <form method="POST" action="annuaire" accept-charset="utf-8">
            {!! csrf_field() !!}
            <div class="row">
              <div class="medium-3 columns">
                <fieldset>
                  <legend>Identification</legend>
                  <label>Nom :
                    <input name="last_name" type="text" />
                  </label>

                  <label>Prénom :
                    <input name="first_name" type="text" />
                  </label>
                </fieldset>
                <fieldset>
                  <legend>Rôles</legend>
@foreach(\App\Models\Role::all() as $r)
                  <input id="role{{ $r->id }}" name="role[]" type="checkbox" value="{{ $r->id }}" />
                  <label for="role{{ $r->id }}">{{ $r->name }}</label>
                  <br />
@endforeach
                </fieldset>
              </div>
              <div class="medium-6 columns">
                <fieldset>
                  <legend>Adresse</legend>
                  <div class="row">
                    <div class="small-6 medium-4 columns">
                      <label>Numéro de rue :
                        <input id="street_number" name="street_number" type="number" />
                      </label>
                    </div>
                    <div class="small-1 medium-3 columns"></div>
                    <div class="small-5 medium-5 columns">
                      <label>Type de rue :
                        <select name="street_type">
                          <option></option>
@foreach(array('rue', 'allée', 'boulevard', 'chemin', 'route') as $value)
                          <option>{{ $value }}</option>
@endforeach
                        </select>
                      </label>
                    </div>
                  </div>
                  <label>Nom de la rue :
                    <input name="street_name" type="text" />
                  </label>
                  <label>Complément :
                    <input name="street_complement" type="text" />
                  </label>
                  <div class="row">
                    <div class="small-5 medium-4 columns">
                      <label>Code postal :
                        <input id="zipcode" name="zip" type="number" />
                      </label>
                    </div>
                    <div class="small-1 medium-1 columns"></div>
                    <div class="small-6 medium-7 columns">
                      <label>Ville :
                        <input name="city" type="text" />
                      </label>
                    </div>
                  </div>
                </fieldset>
              </div>
              <div class="medium-3 columns">
                <fieldset>
                  <legend>Contact</legend>
@foreach(array('fixe', 'portable') as $type)
                  <label>Téléphone {{ $type }} :
                    <input name="telephone[{{ substr($type, 0, 4) }}]" type="tel" />
                  </label>
@endforeach
@foreach(array('principal', 'secondaire') as $type)
                  <label>Mail ({{ $type }}) :
                    <input name="emails[]" type="email" />
                  </label>
@endforeach
                </fieldset>
              </div>
            </div>
            <input class="button float-right" id="submit" name="submit" type="submit" value="Ajouter" />
          </form>
@stop
