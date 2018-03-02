            <fieldset>
              <legend>Contact</legend>
@foreach ($phones as $phone)
              <div class="mdc-text-field">
                <input class="mdc-text-field__input"
                       id="telephone[{{ $phone['short'] }}]"
                       name="telephone[{{ $phone['short'] }}]"
                       type="tel"
                       value="{{ $phone['number'] }}">
                <label class="mdc-text-field__label" for="telephone[{{ $phone['short'] }}]">
                  Téléphone {{ $phone['long'] }}
                </label>
                <div class="mdc-line-ripple"></div>
              </div>
@endforeach
@foreach ($emails as $email)
              <div class="mdc-text-field">
                <input class="mdc-text-field__input"
                       id="email[{{ $email['type'] }}]"
                       name="email[{{ $email['type'] }}]"
                       type="email"
                       value="{{ $email['val'] }}">
                <label class="mdc-text-field__label" for="email[{{ $email['type'] }}]">
                  Mail ({{ $email['type'] }})
                </label>
                <div class="mdc-line-ripple"></div>
              </div>
@endforeach
            </fieldset>
