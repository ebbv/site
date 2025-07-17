@extends(config('app.theme'))

@php
$passages = 'apocalypse 15-16, apocalypse 17, apocalypse 18, apocalypse 19, apocalypse 20, apocalypse 21, apocalypse 22,
            genese 1, genese 2, genese 3, genese 4-5, genese 6, genese 7, genese 8-9, genese 10, genese 11, genese 12-13,
            genese 14, genese 15-16, genese 17, genese 18, genese 19, genese 20-21, genese 22-23, genese 24, genese 25,
            genese 26, genese 27, genese 28, genese 29, genese 30';
@endphp

@section('content')
  <ol id="bible-reading">
@foreach (explode(',', $passages) as $passage)
    <li>
      <span>{{ $passage }}</span>
      <div>o</div>
    </li>
@endforeach
  </ol>
@endsection
