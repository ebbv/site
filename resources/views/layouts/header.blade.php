    <header class="mdc-toolbar mdc-toolbar--fixed mdc-toolbar--waterfall">
      <div class="mdc-toolbar__row">
        <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
          <a href="#" class="material-icons mdc-toolbar__menu-icon">menu</a>
          <span class="mdc-toolbar__title mdc-toolbar__title--full">Eglise Biblique Baptiste de Vernon</span>
          <span class="mdc-toolbar__title mdc-toolbar__title--mini">EBBV</span>
        </section>
      </div>
      <aside class="mdc-temporary-drawer">
        <nav class="mdc-temporary-drawer__drawer">
          <div class="mdc-temporary-drawer__toolbar-spacer"></div>
          <nav class="mdc-temporary-drawer__content mdc-list">
@foreach (__('nav') as $key => $value)
@if (Auth::check() and $key == 'login')
@continue
@elseif (! Auth::check() and $key == 'logout')
@continue
@endif
@if (array_key_exists('text', $value))
            <a class="mdc-list-item" href="{{ $value['url'] }}">
              <span class="mdc-list-item__start-detail" aria-hidden="true">{{ $value['text'] }}</span>
            </a>
@endif
@endforeach
          </nav>
        </nav>
      </aside>
    </header>
