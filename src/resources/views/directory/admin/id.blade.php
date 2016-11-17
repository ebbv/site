                <fieldset>
                  <legend>Identité</legend>
                  <label>Nom :
                    <input name="last_name" type="text" value="{{ $m->last_name or '' }}" />
                  </label>
                  <label>Prénom :
                    <input name="first_name" type="text" value="{{ $m->first_name or '' }}" />
                  </label>
                </fieldset>
