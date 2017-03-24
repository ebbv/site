                <fieldset>
                  <legend>Contact</legend>
@foreach ($phones as $phone)
                  <label>Téléphone {{ $phone['long'] }} :
                    <input name="telephone[{{ $phone['short'] }}]" type="tel" value="{{ $phone['number'] }}" />
                  </label>
@endforeach
@foreach ($emails as $email)
                  <label>Mail ({{ $email['type'] }}) :
                    <input name="email[{{ $email['type'] }}]" type="email" value="{{ $email['val'] }}" />
                  </label>
@endforeach
                </fieldset>
