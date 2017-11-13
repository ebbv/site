            <fieldset id="address">
              <legend>Adresse</legend>
              <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2-desktop">
                    <div class="mdc-textfield">
                      <input class="mdc-textfield__input"
                             id="street_number"
                             name="street_number"
                             type="number"
                             value="{{ $m->address->street_number or '' }}">
                      <label class="mdc-textfield__label" for="street_number">Numéro</label>
                      <div class="mdc-textfield__bottom-line"></div>
                    </div>
                  </div>
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3-desktop">
                    <select class="mdc-select" name="street_type">
                      <option>Type de rue...</option>
@foreach ($street_type as $type)
                      <option{{ $type['selected'] }}>{{ $type['name'] }}</option>
@endforeach
                    </select>
                  </div>
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-7-desktop">
                    <div class="mdc-textfield">
                      <input class="mdc-textfield__input"
                             name="street_name"
                             type="text"
                             value="{{ $m->address->street_name or '' }}">
                      <label class="mdc-textfield__label">Nom de la rue</label>
                      <div class="mdc-textfield__bottom-line"></div>
                    </div>
                  </div>
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-7-desktop">
                    <div class="mdc-textfield">
                      <input class="mdc-textfield__input"
                             name="street_complement"
                             type="text"
                             value="{{ $m->address->street_complement or '' }}">
                      <label class="mdc-textfield__label">Complément</label>
                      <div class="mdc-textfield__bottom-line"></div>
                    </div>
                  </div>
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3-desktop">
                    <div class="mdc-textfield">
                      <input class="mdc-textfield__input"
                             id="zipcode"
                             name="zip"
                             type="number"
                             value="{{ $m->address->zip or '' }}">
                      <label class="mdc-textfield__label">Code postal</label>
                      <div class="mdc-textfield__bottom-line"></div>
                    </div>
                  </div>
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-5-desktop">
                    <div class="mdc-textfield">
                      <input class="mdc-textfield__input"
                             name="city"
                             type="text"
                             value="{{ $m->address->city or '' }}">
                      <label class="mdc-textfield__label">Ville</label>
                      <div class="mdc-textfield__bottom-line"></div>
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
