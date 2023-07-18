@extends(config('app.theme'))

@section('content')
          <form accept-charset="utf-8"
                action="{{ route('messages.store') }}"
                class="mdc-layout-grid__inner"
                id="add-message"
                method="POST">
            @csrf

            <div class="mdc-layout-grid__cell
                        mdc-layout-grid__cell--span-5-tablet
                        mdc-layout-grid__cell--span-8-desktop">
@error('title')
              <div class="error">
                Merci de bien vouloir indiquer un titre
              </div>
@enderror
              <div class="mdc-text-field mdc-text-field--filled">
                <span class="mdc-text-field__ripple"></span>
                <span class="mdc-floating-label" id="title">Titre</span>
                <input arialabelledby="title"
                       class="mdc-text-field__input"
                       name="title"
                       required
                       type="text"
                       value="{{ old('title') }}">
                <span class="mdc-line-ripple"></span>
              </div>
            </div>
            <div class="mdc-layout-grid__cell
                        mdc-layout-grid__cell--span-3-tablet
                        mdc-layout-grid__cell--span-4-desktop">
@error('user_id')
              <div class="error">
                Merci de bien vouloir choisir un orateur
              </div>
@enderror
              <div class="mdc-select mdc-select--filled mdc-select--required">
                <div class="mdc-select__anchor"
                     role="button"
                     aria-haspopup="listbox"
                     aria-expanded="false"
                     aria-labelledby="speaker-label speaker-selected-text">
                  <span class="mdc-select__ripple"></span>
                  <span id="speaker-label" class="mdc-floating-label">Prédicateur</span>
                  <span class="mdc-select__selected-text-container">
                    <span id="speaker-selected-text" class="mdc-select__selected-text"></span>
                  </span>
                  <span class="mdc-select__dropdown-icon">
                    <svg
                        class="mdc-select__dropdown-icon-graphic"
                        viewBox="7 10 10 5" focusable="false">
                      <polygon
                          class="mdc-select__dropdown-icon-inactive"
                          stroke="none"
                          fill-rule="evenodd"
                          points="7 10 12 15 17 10">
                      </polygon>
                      <polygon
                          class="mdc-select__dropdown-icon-active"
                          stroke="none"
                          fill-rule="evenodd"
                          points="7 15 12 10 17 15">
                      </polygon>
                    </svg>
                  </span>
                  <span class="mdc-line-ripple"></span>
                </div>
                <div class="mdc-menu mdc-menu-surface mdc-select__menu">
                  <ul class="mdc-deprecated-list">
@foreach ($speakers as $s)
                    <li class="mdc-deprecated-list-item" data-value="{{ $s->id }}">
                      <span class="mdc-deprecated-list-item__ripple"></span>
                      <span class="mdc-deprecated-list-item__text">
                        {{ $s->last_name }}, {{ $s->first_name }}
                      </span>
                    </li>
@endforeach
                  </ul>
                </div>
                <input name="user_id" type="hidden" />
              </div>
            </div>
            <div class="mdc-layout-grid__cell
                        mdc-layout-grid__cell--span-4-tablet
                        mdc-layout-grid__cell--span-7-desktop">
@error('passage')
              <div class="error">
                Merci de bien vouloir indiquer un passage
              </div>
@enderror
              <div class="mdc-text-field mdc-text-field--filled">
                <span class="mdc-text-field__ripple"></span>
                <span class="mdc-floating-label" id="passage">Passage</span>
                <input arialabelledby="passage"
                       class="mdc-text-field__input"
                       name="passage"
                       required
                       type="text"
                       value="{{ old('passage') }}">
                <span class="mdc-line-ripple"></span>
              </div>
            </div>
            <div class="mdc-layout-grid__cell
                        mdc-layout-grid__cell--span-2-tablet
                        mdc-layout-grid__cell--span-3-desktop">
@error('date')
              <div class="error">
                Merci de bien vouloir choisir un fichier
              </div>
@enderror
              <div class="mdc-select mdc-select--filled mdc-select--required">
                <div class="mdc-select__anchor"
                     role="button"
                     aria-haspopup="listbox"
                     aria-expanded="false"
                     aria-labelledby="file-label file-selected-text">
                  <span class="mdc-select__ripple"></span>
                  <span id="file-label" class="mdc-floating-label">Choisir un fichier</span>
                  <span class="mdc-select__selected-text-container">
                    <span id="file-selected-text" class="mdc-select__selected-text"></span>
                  </span>
                  <span class="mdc-select__dropdown-icon">
                    <svg
                        class="mdc-select__dropdown-icon-graphic"
                        viewBox="7 10 10 5" focusable="false">
                      <polygon
                          class="mdc-select__dropdown-icon-inactive"
                          stroke="none"
                          fill-rule="evenodd"
                          points="7 10 12 15 17 10">
                      </polygon>
                      <polygon
                          class="mdc-select__dropdown-icon-active"
                          stroke="none"
                          fill-rule="evenodd"
                          points="7 15 12 10 17 15">
                      </polygon>
                    </svg>
                  </span>
                  <span class="mdc-line-ripple"></span>
                </div>
                <div class="mdc-menu mdc-menu-surface mdc-select__menu">
                  <ul class="mdc-deprecated-list">
@foreach ($files as $f)
                    <li class="mdc-deprecated-list-item" data-value="{{ $f }}">
                      <span class="mdc-deprecated-list-item__ripple"></span>
                      <span class="mdc-deprecated-list-item__text">
                        {{ $f }}
                      </span>
                    </li>
@endforeach
                  </ul>
                </div>
                <input name="date" type="hidden" />
              </div>
            </div>
            <div class="mdc-layout-grid__cell
                        mdc-layout-grid__cell--span-2-tablet
                        mdc-layout-grid__cell--span-2-desktop">
              <button class="mdc-button mdc-button--raised" style="float: right; top: 35%" type="submit">
                @lang('forms.add_button')

              </button>
            </div>
          </form>
@endsection
