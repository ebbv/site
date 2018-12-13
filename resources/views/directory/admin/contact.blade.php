            <div>
<?php $temp = isset($m) ? array_pluck($m->phones->toArray(), 'type', 'number') : [] ?>
@foreach ($phones as $key => $value)
              <div class="mdc-select mdc-select--outlined">
                <i class="mdc-select__dropdown-icon"></i>
                <select class="mdc-select__native-control" name="telephone[{{ $key }}][id]">
                  <option></option>
@foreach ($value as $id => $number)
                  <option {{ (array_search($key, $temp) === $number) ? 'selected ' : '' }}value="{{ $id }}">{{ $number }}</option>
@endforeach
                </select>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="telephone-{{ $key }}"
                       name="telephone[{{ $key }}][number]"
                       type="tel"
                       value="{{ array_search($key, $temp) }}">
                <label class="mdc-floating-label" for="telephone[{{ $key }}]">Téléphone {{ $key }}</label>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
@endforeach
<?php $temp = isset($m) ? array_pluck($m->emails->toArray(), 'type', 'address') : [] ?>
@foreach (['principal', 'secondaire'] as $key => $value)
              <div class="mdc-select mdc-select--outlined">
                <i class="mdc-select__dropdown-icon"></i>
                <input name="email[{{ $key }}][type]"  type="hidden" value="{{ $value }}">
                <select class="mdc-select__native-control" name="email[{{ $key }}][id]">
                    <option></option>
@foreach ($emails as $email)
                    <option {{ (array_search($value, $temp) === $email->address) ? 'selected ' : '' }}value="{{ $email->id }}">{{ $email->address }}</option>
@endforeach
                </select>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="email[{{ $value }}]"
                       name="email[{{ $key }}][address]"
                       type="email"
                       value="{{ (array_search($value, $temp)) }}">
                <label class="mdc-floating-label" for="email[{{ $value }}]">E-mail ({{ $value }})</label>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
@endforeach
            </div>
