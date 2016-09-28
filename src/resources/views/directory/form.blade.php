            {!! csrf_field() !!}
            <div class="row">
              <div class="medium-3 columns">
                <fieldset>
                  <legend>Identification</legend>
                  <label>Nom :
                    <input name="last_name" type="text" value="{{ $m->last_name or '' }}" />
                  </label>
                  <label>Prénom :
                    <input name="first_name" type="text" value="{{ $m->first_name or '' }}" />
                  </label>
                </fieldset>
                <fieldset id="roles">
                  <legend>Rôles</legend>
@foreach(\App\Models\Role::all() as $r)
<?php if(isset($m->roles)) {
foreach($m->roles as $role) {
  if($r->name == $role->name) {
    $check = 'checked';
    break;
  }
  else {
    $check = '';
  }
}
}?>
                  <input id="role{{ $r->id }}" name="role[]" type="checkbox" value="{{ $r->id }}" {{ $check or '' }} />
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
                        <input id="street_number" name="street_number" type="number" value="{{ $m->address->street_number or '' }}" />
                      </label>
                    </div>
                    <div class="small-1 medium-3 columns"></div>
                    <div class="small-5 medium-5 columns">
                      <label>Type de rue :
                        <select name="street_type">
                          <option></option>
@foreach(['rue', 'allée', 'boulevard', 'chemin', 'route'] as $value)
                          <option<?php if(isset($m->address->street_type) AND $value == $m->address->street_type) echo ' selected'; ?>>{{ $value }}</option>
@endforeach
                        </select>
                      </label>
                    </div>
                  </div>
                  <label>Nom de la rue :
                    <input name="street_name" type="text" value="{{ $m->address->street_name or '' }}" />
                  </label>
                  <label>Complément :
                    <input name="street_complement" type="text" value="{{ $m->address->street_complement or '' }}" />
                  </label>
                  <div class="row">
                    <div class="small-5 medium-4 columns">
                      <label>Code postal :
                        <input id="zipcode" name="zip" type="number" value="{{ $m->address->zip or '' }}" />
                      </label>
                    </div>
                    <div class="small-1 medium-1 columns"></div>
                    <div class="small-6 medium-7 columns">
                      <label>Ville :
                        <input name="city" type="text" value="{{ $m->address->city or '' }}" />
                      </label>
                    </div>
                  </div>
                </fieldset>
              </div>
              <div class="medium-3 columns">
                <fieldset>
                  <legend>Contact</legend>
@foreach(['fixe', 'portable'] as $type)
<?php if(isset($m->phones)) {
foreach($m->phones as $p) {
  if($p->type == ucfirst(substr($type, 0, 4)))
  {
    $phone_number = $p->number;
    break;
  }
}
}?>
                  <label>Téléphone {{ $type }} :
                    <input name="telephone[{{ substr($type, 0, 4) }}]" type="tel" value="{{ $phone_number or '' }}" />
                  </label>
@endforeach
@foreach(['principal', 'secondaire'] as $key => $type)
                  <label>Mail ({{ $type }}) :
                    <input name="emails[]" type="email" value="<?php if(isset($m->emails[$key])) echo $m->emails[$key]->address; ?>" />
                  </label>
@endforeach
                </fieldset>
              </div>
            </div>
@if(isset($submitButtonText))
            <input name="id" type="hidden" value="{{ $m->id }}" />
            <input class="alert button float-right" id="delete" name="submit" type="submit" value="Supprimer" />
@endif
            <input class="button float-right" id="submit" name="submit" type="submit" value="{{ $submitButtonText or 'Ajouter' }}" />
