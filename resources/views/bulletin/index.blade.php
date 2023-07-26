@extends(config('app.theme'))

@section('content')
  <iframe allowfullscreen id="bulletin-iframe" src="storage/bulletin/{{ $fileName }}.pdf"></iframe>
@endsection
