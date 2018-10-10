@extends(config('app.theme'))

@section('content')
          <p>
            Nous sommes désolés mais vous n'avez pas l'autorisation nécessaire pour cette action.
          </p>
          <a href="{{ url()->previous() }}">Revenir à la page précédente</a>
@endsection
