            <div>
<?php $temp = isset($m) ? array_pluck($m->phones->toArray(), 'type', 'number') : [] ?>
@foreach ($phones as $key => $value)
              <p>
                <select name="telephone[{{ $key }}][id]">
                  <option></option>
@foreach ($value as $id => $number)
                  <option {{ (array_search($key, $temp) === $number) ? 'selected ' : '' }}value="{{ $id }}">{{ $number }}</option>
@endforeach
                </select>
                <label for="telephone[{{ $key }}]">Téléphone {{ $key }}</label>
                <input id="telephone-{{ $key }}"
                       name="telephone[{{ $key }}][number]"
                       type="tel"
                       value="{{ array_search($key, $temp) }}">
              </p>
@endforeach
<?php $temp = isset($m) ? array_pluck($m->emails->toArray(), 'type', 'address') : [] ?>
@foreach (['principal', 'secondaire'] as $key => $value)
              <p>
                <input name="email[{{ $key }}][type]"  type="hidden" value="{{ $value }}">
                <select name="email[{{ $key }}][id]">
                    <option></option>
@foreach ($emails as $email)
                    <option {{ (array_search($value, $temp) === $email->address) ? 'selected ' : '' }}value="{{ $email->id }}">{{ $email->address }}</option>
@endforeach
                </select>
                <label for="email[{{ $value }}]">E-mail ({{ $value }})</label>
                <input id="email[{{ $value }}]"
                       name="email[{{ $key }}][address]"
                       type="email"
                       value="{{ (array_search($value, $temp)) }}">
              </p>
@endforeach
            </div>
