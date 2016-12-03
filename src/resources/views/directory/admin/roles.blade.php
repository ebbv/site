                <fieldset id="roles">
                  <legend>Rôles</legend>
@foreach (\App\Models\Role::all() as $r)
<?php if (isset($m->roles)) {
  foreach ($m->roles as $role) {
    if ($r->name == $role->name) {
      $check = 'checked';
      break;
    } else {
      $check = '';
    }
  }
}?>
                  <input id="role{{ $r->id }}" name="role[]" type="checkbox" value="{{ $r->id }}" {{ $check or '' }} />
                  <label for="role{{ $r->id }}">{{ $r->name }}</label>
                  <br />
@endforeach
                </fieldset>
