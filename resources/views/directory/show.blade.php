@extends(config('app.theme'))

@section('content')
          <h4 class="mdc-typography--headline5">{{ $user->fullName }}</h4>
          <hr>
          <div>
@foreach ($user->roles as $role)
            <p>{{ $role->name }}</p>
@endforeach
          </div>
@isset ($user->address)
          <div>
            <p>{{ $user->address->street_info }}</p>
            <p>{{ $user->address->street_complement }}</p>
            <p>{{ $user->address->zip }} {{ $user->address->city }}</p>
          </div>
@endisset
          <div>
@foreach ($user->phones as $phone)
            <p><span>{{ $phone->type }}</span> : {{ $phone->number }}</p>
@endforeach
          </div>
          <div>
@foreach ($user->emails as $email)
            <p><span>{{ $email->pivot->type }}</span> : {{ $email->address }}</p>
@endforeach
          </div>
@can ('update', $user)
          <div class="mdc-card__actions">
            <a href="{{ route('directory.edit', $user->id) }}">
              <i class="material-icons mdc-card__action mdc-card__action--button" role="button">edit</i>
            </a>
            <form method="POST" action="{{ route('directory.destroy', $user->id) }}" accept-charset="utf-8">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <i class="cancel material-icons mdc-card__action mdc-card__action--button" role="button">delete</i>
            </form>
          </div>
@endcan
@endsection
