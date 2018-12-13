            <div>
              <div class="mdc-select mdc-select--outlined">
                <i class="mdc-select__dropdown-icon"></i>
                <select class="mdc-select__native-control" name="address[id]">
                  <option></option>
@foreach ($addresses as $address)
                  <option {{ (isset($m->address) and $address->id == $m->address->id) ? 'selected ' : '' }}value="{{ $address->id }}">
                    {{ $address->fullAddress }}
                  </option>
@endforeach
                </select>
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label">Choisir une adresse</label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id=""
                       name="address[street_info]"
                       type="text"
                       value="{{ $m->address->street_info ?? '' }}">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label">Adresse</label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id=""
                       name="address[street_complement]"
                       type="text"
                       value="{{ $m->address->street_complement ?? '' }}">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label">Complément</label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id=""
                       name="address[zip]"
                       type="number"
                       value="{{ $m->address->zip ?? '' }}">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label">Code postal</label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id=""
                       name="address[city]"
                       type="text"
                       value="{{ $m->address->city ?? '' }}">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label">Ville</label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
            </div>
