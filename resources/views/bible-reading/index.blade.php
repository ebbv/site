@extends(config('app.theme'))

@php
$passages = 'jeremie 10, jeremie 11-12, jeremie 13, jeremie 14-15, jeremie 16, jeremie 17, jeremie 18-19,
  jeremie 20-21, jeremie 22, eremie 23, jeremie 24-25, jeremie 26, jeremie 27-28, jeremie 29, jeremie 30-31,
  jeremie 32, jeremie 33, jeremie 34, jeremie 35, jeremie 36, jeremie 37, jeremie 38, jeremie 39-40,
  jeremie 41-42, jeremie 43-44, jeremie 45-46, jeremie 47-48, jeremie 49, jeremie 50, jeremie 51, jeremie 52'
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
