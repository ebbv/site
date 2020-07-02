    <header class="mdc-top-app-bar mdc-top-app-bar--fixed" id="js-top-app-bar">
      <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
          <button class="material-icons mdc-icon-button mdc-top-app-bar__navigation-icon" id="nav-menu-btn">menu</button>
          <span class="mdc-top-app-bar__title mdc-top-app-bar__title--full">Eglise Biblique Baptiste de Vernon</span>
          <span class="mdc-top-app-bar__title mdc-top-app-bar__title--mini">EBBV</span>
        </section>
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
          <!-- <div style="margin-right: 20px">
@if (config('user_prefered_locale') === null)
            <a class="mdc-button mdc-button--raised" href="en/messages">EN</a>
@else
            <a class="mdc-button mdc-button--raised" href="messages">FR</a>
@endif
          </div> -->
@if (url()->current() !== route('login'))
@if (Auth::check())
          <div id="account-menu-button">
            <span>{{ auth()->user()->fullname }}</span>
            <i class="material-icons">
              keyboard_arrow_down
            </i>
          </div>
          <div class="mdc-menu mdc-menu-surface" id="account-menu" tabindex="-1">
            <div aria-hidden="true" class="mdc-list mdc-menu__items" role="menu">
              <a class="mdc-list-item"
                 href="{{ auth()->user()->path().'/'.__('nav.actions.edit') }}"
                 role="menuitem">
                Mes Infos ({{ auth()->user()->username }})
              </a>
              <form accept-charset="utf-8" action="{{ route('logout') }}" id="logout-form" method="POST">
                @csrf

              </form>
              <a class="mdc-list-item" href="{{ route('logout') }}" id="logout-button" role="menuitem">
                {{ __('nav.logout.text') }}
              </a>
            </div>
          </div>
@else
          <a class="mdc-button mdc-button--raised" href="{{ route('login') }}">
            {{ __('nav.login.text') }}
          </a>
@endif
@endif
        </section>
      </div>
    </header>

    <aside class="mdc-drawer mdc-drawer--modal" id="js-app-drawer">
      <div class="mdc-drawer__content">
        <nav class="mdc-list">
@foreach (['messages', 'contact', 'beliefs', 'directory'] as $uri)
          <a class="mdc-list-item{{ (url()->current() == route($uri.'.index')) ? ' mdc-list-item--activated' : '' }}"
             href="{{ route($uri.'.index') }}"
             id="{{ $uri }}-link"
             tabindex="0">
            <span class="mdc-list-item__ripple"></span>
            <span class="mdc-list-item__text">{{ __('nav.'.$uri.'.text') }}</span>
          </a>
@endforeach
        </nav>
      </div>
    </aside>
