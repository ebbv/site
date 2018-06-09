@extends(config('app.theme'))

@section('content')
          <h4 class="mdc-typography--headline5">{{ $user->fullName }}</h4>
          <hr>
          <div>
@foreach ($user->roles as $role)
            <p>{{ $role->name }}</p>
@endforeach
          </div>
          <div>
            <p>
@isset ($user->address)
              <span>{{ $user->address->streetAddress }}</span><br>
              <span>{{ $user->address->zip }} {{ $user->address->city }}</span>
@endisset
            </p>
          </div>
          <div>
@foreach ($user->phones as $phone)
            <p><span>{{ $phone->type }}</span> : {{ $phone->number }}</p>
@endforeach
          </div>
          <div>
@foreach ($user->emails as $email)
            <p><span>{{ $email->type }}</span> : {{ $email->address }}</p>
@endforeach
          </div>
@endsection
