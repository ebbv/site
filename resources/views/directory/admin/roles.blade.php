            <fieldset id="roles">
              <legend>Rôles</legend>
@foreach ($roles as $r)
              <div class="mdc-form-field">
                <div class="mdc-checkbox">
                  <input class="mdc-checkbox__native-control"
                         id="role{{ $r->id }}"
                         name="role[]"
                         type="checkbox"
                         value="{{ $r->id }}"{{ $r->checked or '' }}>
                  <div class="mdc-checkbox__background">
                    <svg class="mdc-checkbox__checkmark"
                         viewBox="0 0 24 24">
                      <path class="mdc-checkbox__checkmark__path"
                            d="M1.73,12.91 8.1,19.28 22.79,4.59"
                            fill="none"
                            stroke="white" />
                    </svg>
                    <div class="mdc-checkbox__mixedmark"></div>
                  </div>
                </div>
                <label for="role{{ $r->id }}">{{ $r->name }}</label>
              </div>
              <br>
@endforeach
            </fieldset>
