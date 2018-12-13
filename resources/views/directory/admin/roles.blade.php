            <div>
@foreach ($roles as $role)
              <div class="mdc-form-field">
                <div class="mdc-checkbox">
                  <input
@if (isset($m) and array_search($role->id, array_column($m->roles->values()->toArray(), 'id')) !== false)
                         checked
@endif
                         class="mdc-checkbox__native-control"
                         id="role{{ $role->id }}"
                         name="roles[]"
                         type="checkbox"
                         value="{{ $role->id }}">
                  <div class="mdc-checkbox__background">
                    <svg class="mdc-checkbox__checkmark"
                         viewBox="0 0 24 24">
                      <path class="mdc-checkbox__checkmark-path"
                            fill="none"
                            d="M1.73,12.91 8.1,19.28 22.79,4.59">
                      </path>
                    </svg>
                    <div class="mdc-checkbox__mixedmark"></div>
                  </div>
                </div>
                <label for="role{{ $role->id }}">{{ $role->name }}</label>
              </div>
@endforeach
            </div>
