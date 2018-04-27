    <header class="mdc-top-app-bar mdc-top-app-bar--fixed">
      <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
          <a href="#" class="material-icons mdc-top-app-bar__navigation-icon">menu</a>
          <span class="mdc-top-app-bar__title mdc-top-app-bar__title--full">Eglise Biblique Baptiste de Vernon</span>
          <span class="mdc-top-app-bar__title mdc-top-app-bar__title--mini">EBBV</span>
        </section>
      </div>
      <aside class="mdc-drawer mdc-drawer--temporary">
        <nav class="mdc-drawer__drawer">
          <div class="mdc-drawer__toolbar-spacer"></div>
          <nav class="mdc-list mdc-drawer__content">
@foreach (__('nav') as $key => $value)
@if (Auth::check() and $key == 'login')
@continue
@elseif (! Auth::check() and $key == 'logout')
@continue
@endif
@if (array_key_exists('text', $value))
            <a class="mdc-list-item" href="{{ $value['url'] }}" aria-hidden="true">{{ $value['text'] }}</a>
@endif
@endforeach
          </nav>
        </nav>
      </aside>
    </header>
