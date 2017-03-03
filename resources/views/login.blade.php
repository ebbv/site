@extends(config('app.theme'))

@section('content')
        <div id="content" class="small-12 medium-4 medium-centered columns">
          <form method="POST" action="@lang('nav.login.url')" accept-charset="utf-8" id="login" data-abide>
            {{ csrf_field() }}
            <div data-abide-error class="alert callout text-center{{ (session('login_error')) ? '' : ' hide' }}">
                <span><i class="fi-alert"> </i>{{ session('login_error') }}</span>
            </div>
            <div>
              <label>@lang('forms.username')
                <input autofocus autocapitalize="none" id="username" name="username" type="text" value="{{ old('username') }}" required />
                <small class="form-error">@lang('validation.required')</small>
              </label>
            </div>
            <div>
              <label>@lang('forms.password')
                <input id="password" name="password" type="password" required />
                <small class="form-error">@lang('validation.required')</small>
              </label>
            </div>
            <input name="goto" type="hidden" value="{{ old('goto', $goto) }}" />
            <button class="button float-right" type="submit" value="@lang('forms.login_button')">@lang('forms.login_button')</button>
          </form>
@endsection
