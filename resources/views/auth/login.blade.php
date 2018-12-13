@extends(config('app.theme'))

@section('content')
          <form accept-charset="utf-8"
                action="{{ route('login') }}"
                class="mdc-card"
                id="login"
                method="POST">
            {{ csrf_field() }}
@foreach ($errors->all() as $error)
            <p class="error">{{ $error }}</p>
@endforeach
            <section class="mdc-card__primary">
              <div class="mdc-text-field mdc-text-field--outlined">
                <input aria-controls="username-validation-msg"
                       autocapitalize="none"
                       autofocus
                       class="mdc-text-field__input"
                       id="username"
                       name="username"
                       required
                       type="text"
                       value="{{ old('username') }}">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label mdc-floating-label--float-above" for="username">
                      @lang('forms.username')
                    </label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
              <p class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg"
                id="username-validation-msg">
                Obligatoire
              </p>
              <div class="mdc-text-field mdc-text-field--outlined">
                <input aria-controls="password-validation-msg"
                       class="mdc-text-field__input"
                       id="password"
                       name="password"
                       required
                       type="password">
                <div class="mdc-notched-outline">
                  <div class="mdc-notched-outline__leading"></div>
                  <div class="mdc-notched-outline__notch">
                    <label class="mdc-floating-label" for="password">
                      @lang('forms.password')
                    </label>
                  </div>
                  <div class="mdc-notched-outline__trailing"></div>
                </div>
              </div>
              <p class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg"
                id="password-validation-msg">
                Obligatoire
              </p>
            </section>
            <section class="mdc-card__actions">
              <button class="mdc-button mdc-button--raised" type="submit">
                @lang('forms.login_button')
              </button>
            </section>
          </form>
@endsection
