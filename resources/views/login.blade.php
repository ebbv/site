@extends(config('app.theme'))

@section('content')
      <div class="mdc-layout-grid__cell--span-12" id="content">
        <form method="POST" action="@lang('nav.login.url')" accept-charset="utf-8" id="login" class="mdc-card">
          {{ csrf_field() }}
          <section class="mdc-card__primary">
            <div class="mdc-textfield">
              <input aria-controls="username-validation-msg"
                     autocapitalize="none"
                     autofocus
                     class="mdc-textfield__input"
                     id="username"
                     name="username"
                     required
                     type="text"
                     value="{{ old('username') }}">
              <label class="mdc-textfield__label mdc-textfield__label--float-above" for="username">
                @lang('forms.username')
              </label>
            </div>
            <p class="mdc-textfield-helptext mdc-textfield-helptext--validation-msg"
               id="username-validation-msg">
              Obligatoire
            </p>
            <div class="mdc-textfield">
              <input aria-controls="password-validation-msg"
                     class="mdc-textfield__input"
                     id="password"
                     name="password"
                     required
                     type="password">
              <label class="mdc-textfield__label" for="password">
                @lang('forms.password')
              </label>
            </div>
            <p class="mdc-textfield-helptext mdc-textfield-helptext--validation-msg"
               id="password-validation-msg">
              Obligatoire
            </p>
          </section>
          <section class="mdc-card__actions">
            <input name="goto" type="hidden" value="{{ old('goto', $goto) }}">
            <button class="mdc-button mdc-button--primary mdc-button--raised" type="submit">
              @lang('forms.login_button')
            </button>
          </section>
        </form>
@endsection
