            <fieldset>
              <legend>Identité</legend>
              <div class="mdc-text-field">
                <input class="mdc-text-field__input"
                       id="last_name"
                       name="last_name"
                       type="text"
                       value="{{ $m->last_name or '' }}">
                <label class="mdc-text-field__label" for="last_name">
                  Nom
                </label>
                <div class="mdc-line-ripple"></div>
              </div>
              <div class="mdc-text-field">
                <input class="mdc-text-field__input"
                       id="first_name"
                       name="first_name"
                       type="text"
                       value="{{ $m->first_name or '' }}">
                <label class="mdc-text-field__label" for="last_name">
                  Prénom
                </label>
                <div class="mdc-line-ripple"></div>
              </div>
            </fieldset>
