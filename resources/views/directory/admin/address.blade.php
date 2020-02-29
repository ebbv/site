            <div>
              <div class="mdc-select mdc-select--outlined">
                <div class="mdc-select__anchor">
                  <i class="mdc-select__dropdown-icon"></i>
                  <div class="mdc-select__selected-text"></div>
                  <div class="mdc-notched-outline">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch">
                      <span class="mdc-floating-label" id="outlined-select-label">Choisir une adresse</span>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                  </div>
                </div>
                <div class="mdc-menu mdc-menu-surface mdc-select__menu">
                  <ul class="mdc-list">
@foreach ($addresses as $address)
                  <li class="mdc-list-item{{ (isset($m->address) and $address->id == $m->address->id) ? ' mdc-list-item--selected' : '' }}" data-value="{{ $address->id }}">
                    {{ $address->fullAddress }}
                  </li>
@endforeach
                  </ul>
                </div>
                <input name="address[id]" type="hidden" />
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
