        <form accept-charset="utf-8"
              action="{{ $route }}"
              class="mdc-layout-grid"
              id="directory-form"
              method="POST">
          {{ (isset($editButtonText)) ? method_field('PATCH') : '' }}
          {{ csrf_field() }}
          <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3-desktop">
              @include('directory.admin.id')
              @include('directory.admin.roles')
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
              @include('directory.admin.address')
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3-desktop">
              @include('directory.admin.contact')
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3-desktop">
@if (isset($submitButtonText))
              <input name="id" type="hidden" value="{{ $m->id }}">
@endif
              <button class="mdc-button mdc-button--raised mdc-button--primary" type="submit">
                {{ $editButtonText or __('forms.add_button') }}
              </button>
              <a href="{{ route('directory.index') }}">
                <button class="mdc-button mdc-button--raised mdc-button--accent" type="button">
                  @lang('forms.cancel_button')
                </button>
              </a>
            </div>
          </div>
        </form>
