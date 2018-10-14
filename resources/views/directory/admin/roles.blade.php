            <div>
              <p>
@foreach ($roles as $role)
                <label for="role{{ $role->id }}">{{ $role->name }}</label>
                <input id="role{{ $role->id }}"
@isset ($m)
@if (array_search($role->id, array_column($m->roles->values()->toArray(), 'id')) !== false)
                       checked
@endif
@endisset
                       name="roles[]"
                       type="checkbox"
                       value="{{ $role->id }}">
@endforeach
              </p>
            </div>
