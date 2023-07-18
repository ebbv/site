            <div>
<?php $temp = isset($m) ? \Illuminate\Support\Arr::pluck($m->phones->toArray(), 'type', 'number') : [] ?>
@foreach ($phones as $key => $value)
              <div class="mdc-select mdc-select--outlined">
                <div class="mdc-select__anchor" aria-labelledby="phone-{{ $key }}-select-label">
                  <span class="mdc-notched-outline">
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                      <span id="phone-{{ $key }}-select-label" class="mdc-floating-label">Choisir un numéro de téléphone</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                  </span>
                  <span class="mdc-select__selected-text-container">
                    <span id="phone-{{ $key }}-selected-text" class="mdc-select__selected-text"></span>
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
@foreach ($value as $id => $number)
                    <li class="mdc-deprecated-list-item" aria-selected="{{ (array_search($key, $temp) === $number) ? 'true' : 'false' }}" data-value="{{ $id }}" role="option">
                      <span class="mdc-deprecated-list-item__ripple"></span>
                      <span class="mdc-deprecated-list-item__text">
                        {{ $number }}
                      </span>
                    </li>
@endforeach
                  </ul>
                </div>
                <input name="telephone[{{ $key }}][id]" type="hidden" />
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="telephone-{{ $key }}"
                       name="telephone[{{ $key }}][number]"
                       type="tel"
                       value="{{ array_search($key, $temp) }}">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label" for="telephone[{{ $key }}]">Téléphone {{ $key }}</label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
@endforeach
<?php $temp = isset($m) ? \Illuminate\Support\Arr::pluck($m->emails->toArray(), 'type', 'address') : [] ?>
@foreach (['principal', 'secondaire'] as $key => $value)
              <div class="mdc-select mdc-select--outlined">
                <div class="mdc-select__anchor" aria-labelledby="email-{{ $key }}-select-label">
                  <span class="mdc-notched-outline">
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                      <span id="email-{{ $key }}-select-label" class="mdc-floating-label">Choisir une adresse</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                  </span>
                  <span class="mdc-select__selected-text-container">
                    <span id="email-{{ $key }}-selected-text" class="mdc-select__selected-text"></span>
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
@foreach ($emails as $email)
                    <li class="mdc-deprecated-list-item" aria-selected="{{ (array_search($value, $temp) === $email->address) ? 'true' : 'false' }}" data-value="{{ $id }}" role="option">
                      <span class="mdc-deprecated-list-item__ripple"></span>
                      <span class="mdc-deprecated-list-item__text">
                        {{ $email->address }}
                      </span>
                    </li>
@endforeach
                  </ul>
                </div>
                <input name="email[{{ $key }}][id]" type="hidden" />
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="email[{{ $value }}]"
                       name="email[{{ $key }}][address]"
                       type="email"
                       value="{{ (array_search($value, $temp)) }}">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label" for="email[{{ $value }}]">E-mail ({{ $value }})</label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
@endforeach
            </div>
