            <div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="first-name"
                       name="user[first_name]"
                       type="text"
                       value="{{ $m->first_name ?? '' }}">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label" for="first-name">Prénom</label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="last-name"
                       name="user[last_name]"
                       type="text"
                       value="{{ $m->last_name ?? '' }}">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label" for="last-name">Nom</label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="username"
                       name="user[username]"
                       type="text"
                       value="{{ $m->username ?? '' }}">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label" for="username">Nom d'utilisateur</label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="passord"
                       name="user[password]"
                       type="password"
                       value="">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label" for="password">Mot de passe</label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
            </div>
