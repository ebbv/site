@extends(config('app.theme'))

@php
$passages = 'marc 1, marc 2-3, marc 4-5, marc 6, marc 7, marc 8, marc 9, marc 10-11, marc 12, marc 13,
            marc 14, marc 15-16, luc 1, luc 2, luc 3, luc 4, luc 5, luc 6, luc 7, luc 8, luc 9, luc 10,
            luc 11, luc 12, luc 13, luc 14-15, luc 16, luc 17-18'
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
