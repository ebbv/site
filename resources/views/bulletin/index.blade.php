@extends(config('app.theme'))

@section('content')
  <iframe allowfullscreen style="aspect-ratio: 4/3; border: none; width: 100%" src="storage/bulletin/{{ $fileName }}.pdf"></iframe>
@endsection
