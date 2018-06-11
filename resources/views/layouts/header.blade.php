    <header class="mdc-top-app-bar mdc-top-app-bar--fixed" id="js-top-app-bar">
      <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
          <button class="material-icons mdc-top-app-bar__navigation-icon" id="nav-menu-btn">menu</button>
          <span class="mdc-top-app-bar__title mdc-top-app-bar__title--full">Eglise Biblique Baptiste de Vernon</span>
          <span class="mdc-top-app-bar__title mdc-top-app-bar__title--mini">EBBV</span>
        </section>
@if (url()->current() !== route('login'))
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
@if (Auth::check())
          <div id="account-menu-button">
            <span>{{ auth()->user()->fullname }}</span>
            <i class="material-icons">
              keyboard_arrow_down
            </i>
          </div>
          <div class="mdc-menu" id="account-menu" tabindex="-1">
            <div aria-hidden="true" class="mdc-list mdc-menu__items" role="menu">
              <a class="mdc-list-item" href="{{ auth()->user()->path() }}" role="menuitem">
                Mes Infos ({{ auth()->user()->username }})
              </a>
              <form accept-charset="utf-8" action="{{ route('logout') }}" id="logout-form" method="POST">
                {{ csrf_field() }}
              </form>
              <a class="mdc-list-item" href="{{ route('logout') }}" id="logout-button" role="menuitem">
                {{ __('nav.logout.text') }}
              </a>
            </div>
          </div>
@else
          <a class="mdc-list-item" href="{{ route('login') }}" role="menuitem">
            {{ __('nav.login.text') }}
          </a>
@endif
          {{-- <span>Connecté !</span> --}}
        </section>
@endif
      </div>
      <aside class="mdc-drawer mdc-drawer--temporary" id="js-app-drawer">
        <nav class="mdc-drawer__drawer">
          <div class="mdc-drawer__toolbar-spacer"></div>
          <nav class="mdc-drawer__content mdc-list">
            <a class="mdc-list-item" href="/" id="home-link" aria-hidden="true">
              {{ __('nav.home.text') }}
            </a>
            <a class="mdc-list-item" href="{{ route('contact') }}" id="contact-link" aria-hidden="true">
              {{ __('nav.contact.text') }}
            </a>
            <a class="mdc-list-item" href="{{ route('beliefs') }}" id="beliefs-link" aria-hidden="true">
              {{ __('nav.beliefs.text') }}
            </a>
            <a class="mdc-list-item" href="{{ route('directory') }}" id="directory-link" aria-hidden="true">
              {{ __('nav.directory.text') }}
            </a>
          </nav>
        </nav>
      </aside>
    </header>
