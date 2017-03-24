          <form id="directory-form" method="POST" action="{{ $route }}" accept-charset="utf-8">
            {{ (isset($submitButtonText)) ? method_field('PATCH') : '' }}
            {{ csrf_field() }}
            <div class="row">
              <div class="medium-3 columns">
                @include('directory.admin.id')
                @include('directory.admin.roles')
              </div>
              <div class="medium-6 columns">
                @include('directory.admin.address')
              </div>
              <div class="medium-3 columns">
                @include('directory.admin.contact')
              </div>
            </div>
@if (isset($submitButtonText))
            <input name="id" type="hidden" value="{{ $m->id }}" />
@endif
            <input class="button float-right" id="submit" name="submit" type="submit" value="{{ $submitButtonText or __('forms.add_button') }}" />
          </form>
