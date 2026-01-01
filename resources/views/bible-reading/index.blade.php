@extends(config('app.theme'))

@php
$passages = '1 samuel 1, 1 samuel 2, 1 samuel 3-4, 1 samuel 5-6, 1 samuel 7-8, 1 samuel 9, 1 samuel 10-11, 1 samuel 12-13,
            1 samuel 14, 1 samuel 15, 1 samuel 16, 1 samuel 17, 1 samuel 18-19, 1 samuel 20, 1 samuel 21-22, 1 samuel 23-24,
            1 samuel 25, 1 samuel 26-27, 1 samuel 28-29, 1 samuel 30-31, 2 samuel 1, 2 samuel 2, 2 samuel 3-4, 2 samuel 5-6,
            2 samuel 7-8, 2 samuel 9-10, 2 samuel 11, 2 samuel 12, 2 samuel 13, 2 samuel 14, 2 samuel 15';
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
