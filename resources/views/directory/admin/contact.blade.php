            <div>
<?php $temp = isset($m) ? array_pluck($m->phones->toArray(), 'type', 'number') : [] ?>
@foreach (['fixe', 'portable'] as $key => $value)
              <p>
                <input name="telephone[{{ $key }}][type]"  type="hidden" value="{{ $value }}">
                <select name="telephone[{{ $key }}][id]">
                  <option></option>
@foreach (App\Phone::where('type', $value)->orderBy('number')->get() as $phone)
                  <option {{ (array_search($value, $temp) === $phone->number) ? 'selected ' : '' }}value="{{ $phone->id }}">{{ $phone->number }}</option>
@endforeach
                </select>
                <label for="telephone[{{ $value }}]">Téléphone {{ $value }}</label>
                <input id="telephone[{{ $value }}]"
                       name="telephone[{{ $key }}][number]"
                       type="tel"
                       value="{{ array_search($value, $temp) }}">
              </p>
@endforeach
<?php $temp = isset($m) ? array_pluck($m->emails->toArray(), 'pivot.type', 'address') : [] ?>
@foreach (['principal', 'secondaire'] as $key => $value)
              <p>
                <input name="email[{{ $key }}][type]"  type="hidden" value="{{ $value }}">
                <select name="email[{{ $key }}][id]">
                    <option></option>
@foreach (App\Email::orderBy('address')->get() as $email)
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
