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
              <div class="mdc-text-field">
                <input class="mdc-text-field__input"
                       id="title"
                       name="title"
                       required
                       type="text"
                       value="{{ old('title') }}">
                <label class="mdc-floating-label" for="title">
                  Titre
                </label>
                <div class="mdc-line-ripple"></div>
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
              <div class="mdc-select mdc-select--required">
                <div class="mdc-select__anchor">
                  <i class="mdc-select__dropdown-icon"></i>
                  <div aria-required="true" class="mdc-select__selected-text"></div>
                  <span class="mdc-floating-label">Prédicateur </span>
                  <div class="mdc-line-ripple"></div>
                </div>
                <div class="mdc-menu mdc-menu-surface mdc-select__menu">
                  <ul class="mdc-list">
@foreach ($speakers as $s)
                    <li class="mdc-list-item" data-value="{{ $s->id }}">
                      {{ $s->last_name }}, {{ $s->first_name }}
                    </li>
@endforeach
                  </ul>
                </div>
                <input name="user_id" type="hidden" value="" />
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
              <div class="mdc-text-field">
                <input class="mdc-text-field__input"
                       id="message-passage"
                       name="passage"
                       required
                       type="text"
                       value="{{ old('passage') }}">
                <label class="mdc-floating-label" for="message-passage">
                  Passage
                </label>
                <div class="mdc-line-ripple"></div>
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
              <div class="mdc-select mdc-select--required">
                <div class="mdc-select__anchor">
                  <i class="mdc-select__dropdown-icon"></i>
                  <div aria-required="true" class="mdc-select__selected-text"></div>
                  <span class="mdc-floating-label">Choisir un fichier </span>
                  <div class="mdc-line-ripple"></div>
                </div>
                <div class="mdc-menu mdc-menu-surface mdc-select__menu">
                  <ul class="mdc-list">
@foreach ($files as $f)
                    <li class="mdc-list-item" data-value="{{ $f }}">
                      {{ $f }}
                    </li>
@endforeach
                  </ul>
                </div>
                <input name="date" type="hidden" value="" />
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
