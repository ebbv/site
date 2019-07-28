@extends(config('app.theme'))

@section('content')
          <form accept-charset="utf-8"
                action="{{ $route ?? route('directory.store') }}"
                id="directory-form"
                method="POST">
@isset ($editButtonText)
            @method('PATCH')
@endisset
            @csrf

            @include('directory.admin.id')
@can ('create', App\User::class)
            @include('directory.admin.roles')
@endcan
            @include('directory.admin.address')
            @include('directory.admin.contact')
            <a class="mdc-button mdc-button--cancel mdc-button--raised" href="{{ route('directory.index') }}">@lang('forms.cancel_button')</a>
            <button class="mdc-button mdc-button--raised" type="submit">
              {{ $editButtonText ?? __('forms.add_button') }}
            </button>
          </form>
@endsection
