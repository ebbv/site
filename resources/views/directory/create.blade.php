@extends(config('app.theme'))

@section('content')
          <form accept-charset="utf-8"
                action="{{ route('directory.store') }}"
                id="add-message"
                method="POST">
            {{ csrf_field() }}
            @include('directory.admin.id')
            @include('directory.admin.roles')
            @include('directory.admin.address')
            <a href="{{ route('directory') }}">@lang('forms.cancel_button')</a>
            <input type="submit" value="Ajouter">
          </form>
@endsection
