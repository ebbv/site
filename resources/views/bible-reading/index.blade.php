@extends(config('app.theme'))

@php
$passages = 'jacques 1, jacques 2, jacques 3, jacques 4, jacques 5, 1 pierre 1, 1 pierre 2, 1 pierre 3, 1 pierre 4-5,
            2 pierre 1, 2 pierre 2, 2 pierre 3, 1 jean 1-2, 1 jean 3, 1 jean 4, 1 jean 5, 2 jean 1, 3 jean 1, jude 1,
            apocalypse 1, apocalypse 2, apocalypse 3, apocalypse 4-5, apocalypse 6, apocalypse 7-8, apocalypse 9,
            apocalypse 10-11, apocalypse 12, apocalypse 13, apocalypse 14'
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
