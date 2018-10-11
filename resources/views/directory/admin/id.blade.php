            <div>
              <p>
                <label for="first-name">Prénom</label>
                <input id="first-name"
                       name="user[first_name]"
                       type="text"
                       value="{{ $m->first_name ?? '' }}">
                <label for="last-name">Nom</label>
                <input id="last-name"
                       name="user[last_name]"
                       type="text"
                       value="{{ $m->last_name ?? '' }}">
                <label for="username">Nom d'utilisateur</label>
                <input id="username"
                      name="user[username]"
                      type="text"
                      value="{{ $m->username ?? '' }}">
              </p>
              <label for="password">Mot de passe</label>
              <input id="passord"
                     name="user[password]"
                     type="password"
                     value="{{ $m->password ?? '' }}">
            </div>
