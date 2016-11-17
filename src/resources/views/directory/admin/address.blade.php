                <fieldset>
                  <legend>Adresse</legend>
                  <div class="row">
                    <div class="small-6 medium-5 columns">
                      <label>Numéro de rue :
                        <input id="street_number" name="street_number" type="number" value="{{ $m->address->street_number or '' }}" />
                      </label>
                    </div>
                    <div class="small-1 medium-2 columns"></div>
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
