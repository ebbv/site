            <div>
<?php $temp = isset($m) ? \Illuminate\Support\Arr::pluck($m->phones->toArray(), 'type', 'number') : [] ?>
@foreach ($phones as $key => $value)
              <div class="mdc-select mdc-select--outlined">
                <div class="mdc-select__anchor">
                  <i class="mdc-select__dropdown-icon"></i>
                  <div class="mdc-select__selected-text"></div>
                  <div class="mdc-notched-outline">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch">
                      <span class="mdc-floating-label" id="outlined-select-label">Choisir un numéro de téléphone</span>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                  </div>
                </div>
                <div class="mdc-menu mdc-menu-surface mdc-select__menu">
                  <ul class="mdc-list">
@foreach ($value as $id => $number)
                    <li class="mdc-list-item{{ (array_search($key, $temp) === $number) ? ' mdc-list-item--selected' : '' }}" data-value="{{ $id }}">
                      {{ $number }}
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
@foreach ($emails as $email)
                    <li class="mdc-list-item{{ (array_search($value, $temp) === $email->address) ? ' mdc-list-item--selected' : '' }}" data-value="{{ $email->id }}">
                      {{ $email->address }}
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
