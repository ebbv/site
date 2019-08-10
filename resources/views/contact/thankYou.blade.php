@extends(config('app.theme'))

@section('content')
          <div style="margin: 0 auto; max-width: 300px">
            <p>
              Votre message nous a été communiqué et nous vous répondrons
              dans les meilleurs délais.
            </p>
            <a class="mdc-button mdc-button--raised" href="{{ route('contact.index') }}">
              Revenir au page de contact
            </a>
          </div>
@endsection