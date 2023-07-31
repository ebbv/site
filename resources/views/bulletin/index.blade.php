@extends(config('app.theme'))

@section('content')
  <a href="{{ $url }}?action=download">Télécharger</a>
  <a href="bulletin/2023/juillet">juillet</a>
  <a href="bulletin">mois en cours</a>
  <embed id="bulletin-iframe" type="application/pdf" src="{{ $url }}?action=generate"></embed>
@endsection
