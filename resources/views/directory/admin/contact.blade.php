            <fieldset>
              <legend>Contact</legend>
@foreach ($phones as $phone)
              <div class="mdc-textfield">
                <input class="mdc-textfield__input"
                       id="telephone[{{ $phone['short'] }}]"
                       name="telephone[{{ $phone['short'] }}]"
                       type="tel"
                       value="{{ $phone['number'] }}">
                <label class="mdc-textfield__label" for="telephone[{{ $phone['short'] }}]">
                  Téléphone {{ $phone['long'] }}
                </label>
              </div>
@endforeach
@foreach ($emails as $email)
              <div class="mdc-textfield">
                <input class="mdc-textfield__input"
                       id="email[{{ $email['type'] }}]"
                       name="email[{{ $email['type'] }}]"
                       type="email"
                       value="{{ $email['val'] }}">
                <label class="mdc-textfield__label" for="email[{{ $email['type'] }}]">
                  Mail ({{ $email['type'] }})
                </label>
              </div>
@endforeach
            </fieldset>
