            <fieldset id="address">
              <legend>Adresse</legend>
              <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell
                            mdc-layout-grid__cell--span-1-phone
                            mdc-layout-grid__cell--span-3-tablet
                            mdc-layout-grid__cell--span-2-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input"
                           id="street-number"
                           name="street_number"
                           type="number"
                           value="{{ $m->address->street_number or '' }}">
                    <label class="mdc-floating-label" for="street-number">Numéro</label>
                    <div class="mdc-line-ripple"></div>
                  </div>
                </div>
                <div class="mdc-layout-grid__cell
                            mdc-layout-grid__cell--span-3-phone
                            mdc-layout-grid__cell--span-5-tablet
                            mdc-layout-grid__cell--span-4-desktop">
                  <div class="mdc-select">
                    <select class="mdc-select__native-control" id="street-type" name="street_type">
                      <option></option>
@foreach ($street_type as $type)
                      <option{{ $type['selected'] }}>{{ $type['name'] }}</option>
@endforeach
                    </select>
                    <label class="mdc-floating-label" for="street-type">Type de rue...</label>
                    <div class="mdc-select__bottom-line"></div>
                  </div>
                </div>
                <div class="mdc-layout-grid__cell
                            mdc-layout-grid__cell--span-6-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input"
                           id="street-name"
                           name="street_name"
                           type="text"
                           value="{{ $m->address->street_name or '' }}">
                    <label class="mdc-floating-label" for="street-name">Nom de la rue</label>
                    <div class="mdc-line-ripple"></div>
                  </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-5-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input"
                           id="street-complement"
                           max="5"
                           name="street_complement"
                           type="text"
                           value="{{ $m->address->street_complement or '' }}">
                    <label class="mdc-floating-label" for="street-complement">Complément</label>
                    <div class="mdc-line-ripple"></div>
                  </div>
                </div>
                <div class="mdc-layout-grid__cell
                            mdc-layout-grid__cell--span-2-tablet
                            mdc-layout-grid__cell--span-3-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input"
                           id="zipcode"
                           name="zip"
                           type="number"
                           value="{{ $m->address->zip or '' }}">
                    <label class="mdc-floating-label" for="zipcode">Code postal</label>
                    <div class="mdc-line-ripple"></div>
                  </div>
                </div>
                <div class="mdc-layout-grid__cell
                            mdc-layout-grid__cell--span-6-tablet
                            mdc-layout-grid__cell--span-4-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input"
                           id="city"
                           name="city"
                           type="text"
                           value="{{ $m->address->city or '' }}">
                    <label class="mdc-floating-label" for="city">Ville</label>
                    <div class="mdc-line-ripple"></div>
                  </div>
                </div>
              </div>
            </fieldset>
