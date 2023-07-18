            <div>
              <div class="mdc-select mdc-select--outlined">
                <div class="mdc-select__anchor" aria-labelledby="address-select-label">
                  <span class="mdc-notched-outline">
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                      <span id="address-select-label" class="mdc-floating-label">Choisir une adresse</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                  </span>
                  <span class="mdc-select__selected-text-container">
                    <span id="address-selected-text" class="mdc-select__selected-text"></span>
                  </span>
                  <span class="mdc-select__dropdown-icon">
                    <svg
                        class="mdc-select__dropdown-icon-graphic"
                        viewBox="7 10 10 5" focusable="false">
                      <polygon
                          class="mdc-select__dropdown-icon-inactive"
                          stroke="none"
                          fill-rule="evenodd"
                          points="7 10 12 15 17 10">
                      </polygon>
                      <polygon
                          class="mdc-select__dropdown-icon-active"
                          stroke="none"
                          fill-rule="evenodd"
                          points="7 15 12 10 17 15">
                      </polygon>
                    </svg>
                  </span>
                </div>
                <div class="mdc-menu mdc-menu-surface mdc-select__menu">
                  <ul class="mdc-deprecated-list">
                    <li class="mdc-deprecated-list-item mdc-deprecated-list-item--selected" aria-selected="true" data-value="" role="option">
                      <span class="mdc-deprecated-list-item__ripple"></span>
                    </li>
@foreach ($addresses as $address)
                    <li class="mdc-deprecated-list-item" aria-selected="{{ (isset($m->address) and $address->id == $m->address->id) ? 'true' : 'false' }}" data-value="{{ $address->id }}" role="option">
                      <span class="mdc-deprecated-list-item__ripple"></span>
                      <span class="mdc-deprecated-list-item__text">
                        {{ $address->fullAddress }}
                      </span>
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
