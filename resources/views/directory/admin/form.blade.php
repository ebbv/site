        <form accept-charset="utf-8"
              action="{{ $route }}"
              class="mdc-layout-grid__inner"
              id="directory-form"
              method="POST">
          {{ (isset($editButtonText)) ? method_field('PATCH') : '' }}
          {{ csrf_field() }}
          <div class="mdc-layout-grid__cell
                      mdc-layout-grid__cell--span-3-tablet
                      mdc-layout-grid__cell--span-3-desktop">
            @include('directory.admin.id')
            @include('directory.admin.roles')
          </div>
          <div class="mdc-layout-grid__cell
                      mdc-layout-grid__cell--span-5-tablet
                      mdc-layout-grid__cell--span-6-desktop">
            @include('directory.admin.address')
          </div>
          <div class="mdc-layout-grid__cell
                      mdc-layout-grid__cell--span-3-tablet
                      mdc-layout-grid__cell--span-3-desktop">
            @include('directory.admin.contact')
          </div>
          <div class="mdc-layout-grid__cell
                      mdc-layout-grid__cell--span-8-tablet
                      mdc-layout-grid__cell--span-12-desktop">
            <div id="action-buttons">
@if (isset($submitButtonText))
              <input name="id" type="hidden" value="{{ $m->id }}">
@endif
              <a class="mdc-button mdc-button--cancel mdc-button--raised" href="{{ route('directory.index') }}">
                @lang('forms.cancel_button')
              </a>
              <button class="mdc-button mdc-button--raised" type="submit">
                {{ $editButtonText or __('forms.add_button') }}
              </button>
            </div>
          </div>
        </form>
