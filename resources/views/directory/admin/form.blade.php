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
            <input class="alert button float-right" id="delete" name="submit" type="submit" value="@lang('forms.delete_button')" />
@endif
            <input class="button float-right" id="submit" name="submit" type="submit" value="{{ $submitButtonText or trans('forms.add_button') }}" />
