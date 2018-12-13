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
                <label class="mdc-floating-label">Choisir une adresse</label>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id=""
                       name="address[street_info]"
                       type="text"
                       value="{{ $m->address->street_info ?? '' }}">
                <label class="mdc-floating-label">Adresse</label>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id=""
                       name="address[street_complement]"
                       type="text"
                       value="{{ $m->address->street_complement ?? '' }}">
                <label class="mdc-floating-label">Complément</label>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id=""
                       name="address[zip]"
                       type="number"
                       value="{{ $m->address->zip ?? '' }}">
                <label class="mdc-floating-label">Code postal</label>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id=""
                       name="address[city]"
                       type="text"
                       value="{{ $m->address->city ?? '' }}">
                <label class="mdc-floating-label">Ville</label>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
            </div>
