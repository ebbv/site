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
@foreach ($user->addresses as $address)
              <span>{{ $address->streetAddress }}</span><br>
              <span>{{ $address->zip }} {{ $address->city }}</span>
@endforeach
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
