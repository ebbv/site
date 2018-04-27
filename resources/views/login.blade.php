@extends(config('app.theme'))

@section('content')
      <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12" id="content">
        <form accept-charset="utf-8" action="@lang('nav.login.url')" class="mdc-card" id="login" method="POST">
          {{ csrf_field() }}
          <section class="mdc-card__primary">
            <div class="mdc-text-field mdc-text-field--upgraded">
              <input aria-controls="username-validation-msg"
                     autocapitalize="none"
                     autofocus
                     class="mdc-text-field__input"
                     id="username"
                     name="username"
                     required
                     type="text"
                     value="{{ old('username') }}">
              <label class="mdc-floating-label mdc-floating-label--float-above" for="username">
                @lang('forms.username')
              </label>
              <div class="mdc-line-ripple"></div>
            </div>
            <p class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg"
               id="username-validation-msg">
              Obligatoire
            </p>
            <div class="mdc-text-field">
              <input aria-controls="password-validation-msg"
                     class="mdc-text-field__input"
                     id="password"
                     name="password"
                     required
                     type="password">
              <label class="mdc-floating-label" for="password">
                @lang('forms.password')
              </label>
              <div class="mdc-line-ripple"></div>
            </div>
            <p class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg"
               id="password-validation-msg">
              Obligatoire
            </p>
          </section>
          <section class="mdc-card__actions">
            <input name="goto" type="hidden" value="{{ old('goto', $goto) }}">
            <button class="mdc-button mdc-button--raised" type="submit">
              @lang('forms.login_button')
            </button>
          </section>
        </form>
@endsection
