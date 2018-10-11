@extends(config('app.theme'))

@section('content')
          <form accept-charset="utf-8"
                action="{{ $route ?? route('directory.store') }}"
                id="directory-form"
                method="POST">
            {{ (isset($editButtonText)) ? method_field('PATCH') : '' }}
            {{ csrf_field() }}
            @include('directory.admin.id')
@can ('create', App\User::class)
            @include('directory.admin.roles')
@endcan
            @include('directory.admin.address')
            @include('directory.admin.contact')
            <a href="{{ route('directory') }}">@lang('forms.cancel_button')</a>
            <button type="submit">
              {{ $editButtonText ?? __('forms.add_button') }}
            </button>
          </form>
@endsection
