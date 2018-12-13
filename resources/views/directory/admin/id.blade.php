            <div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="first-name"
                       name="user[first_name]"
                       type="text"
                       value="{{ $m->first_name ?? '' }}">
                <label class="mdc-floating-label" for="first-name">Prénom</label>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="last-name"
                       name="user[last_name]"
                       type="text"
                       value="{{ $m->last_name ?? '' }}">
                <label class="mdc-floating-label" for="last-name">Nom</label>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="username"
                       name="user[username]"
                       type="text"
                       value="{{ $m->username ?? '' }}">
                <label class="mdc-floating-label" for="username">Nom d'utilisateur</label>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input class="mdc-text-field__input"
                       id="passord"
                       name="user[password]"
                       type="password"
                       value="">
                <label class="mdc-floating-label" for="password">Mot de passe</label>
                <div class="mdc-notched-outline">
                  <svg>
                    <path class="mdc-notched-outline__path"></path>
                  </svg>
                </div>
                <div class="mdc-notched-outline__idle"></div>
              </div>
            </div>
