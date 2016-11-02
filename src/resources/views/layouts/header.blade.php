      <header>
        <div class="row" id="site-title">
          <div class="small-12 columns">
            <h1>Eglise Biblique Baptiste de Vernon</h1>
          </div>
        </div>
        <div class="title-bar" data-responsive-toggle="nav" data-hide-for="medium">
          <button class="menu-icon" type="button" data-toggle></button>
          <div class="title-bar-title">MENU</div>
        </div>
        <div class="top-bar" id="nav">
          <div class="row collapse">
            <div class="top-bar-left small-12 columns">
              <ul class="vertical medium-horizontal menu">
                <li><a href="@lang('nav.home.url')">@lang('nav.home.text')</a></li>
                <li><a href="@lang('nav.contact.url')">@lang('nav.contact.text')</a></li>
                <li><a href="@lang('nav.beliefs.url')">@lang('nav.beliefs.text')</a></li>
                <li><a href="@lang('nav.directory.url')">@lang('nav.directory.text')</a></li>
@if(Auth::check())
                <li><a href="@lang('nav.logout.url')">@lang('nav.logout.text')</a></li>
@else
                <li><a href="@lang('nav.login.url')">@lang('nav.login.text')</a></li>
@endif
              </ul>
            </div>
          </div>
        </div>
      </header>
