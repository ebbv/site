            <div>
              <p>
@foreach(\App\Role::orderBy('name', 'asc')->get() as $role)
                <label for="role{{ $role->id }}">{{ $role->name }}</label>
                <input {{ $role->status }} id="role{{ $role->id }}" name="role[]" type="checkbox">
@endforeach
              </p>
            </div>
