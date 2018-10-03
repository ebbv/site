            <div>
              <p>
@foreach(\App\Role::orderBy('name', 'asc')->get() as $role)
                <label for="role{{ $role->id }}">{{ $role->name }}</label>
                <input id="role{{ $role->id }}" name="roles[]" type="checkbox" value="{{ $role->id }}">
@endforeach
              </p>
            </div>
