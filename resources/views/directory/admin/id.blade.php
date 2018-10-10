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
              </p>
            </div>
