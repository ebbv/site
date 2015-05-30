@extends(Config::get('app.theme'))

@section('content')
        <div id="content" class="small-12 columns">
          {{ Form::open(array('route' => 'directory.store')) }}
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
              </div>
              <div class="medium-6 columns">
                <fieldset>
                  <legend>Adresse</legend>
                  <div class="row">
                    <div class="small-6 medium-5 columns">
                      <label>Numéro de rue :
                        <input id="street_number" maxlength="4" name="street_number" type="number" />
                      </label>
                    </div>
                    <div class=" small-6 medium-7 columns">
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
                        <input id="zipcode" maxlength="5" name="zip" type="number" />
                      </label>
                    </div>
                    <div class="small-7 medium-8 columns">
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
            <input class="button right" name="submit" type="submit" value="Ajouter" />
          {{ Form::close() }}
@stop
