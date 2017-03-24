                <fieldset id="roles">
                  <legend>Rôles</legend>
@foreach ($roles as $r)
                  <input id="role{{ $r->id }}" name="role[]" type="checkbox" value="{{ $r->id }}"{{ $r->checked or '' }} />
                  <label for="role{{ $r->id }}">{{ $r->name }}</label>
                  <br />
@endforeach
                </fieldset>
