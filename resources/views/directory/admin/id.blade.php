            <fieldset>
              <legend>Identité</legend>
              <div class="mdc-text-field">
                <input class="mdc-text-field__input"
                       id="last-name"
                       name="last_name"
                       type="text"
                       value="{{ $m->last_name or '' }}">
                <label class="mdc-floating-label" for="last-name">
                  Nom
                </label>
                <div class="mdc-line-ripple"></div>
              </div>
              <div class="mdc-text-field">
                <input class="mdc-text-field__input"
                       id="first-name"
                       name="first_name"
                       type="text"
                       value="{{ $m->first_name or '' }}">
                <label class="mdc-floating-label" for="first-name">
                  Prénom
                </label>
                <div class="mdc-line-ripple"></div>
              </div>
            </fieldset>
