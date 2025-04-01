@extends(config('app.theme'))

@php
$passages = 'actes 20, actes 21, actes 22-23, actes 24-25, actes 26-27, actes 28, romains 1-2, romains 3-4,
            romains 5-6, romains 7-8, romains 9-10, romains 11-12, romains 13-14, romains 15-16, 1 corinthiens 1-2,
            1 corinthiens 3-4, 1 corinthiens 5-6, 1 corinthiens 7-8, 1 corinthiens 9-10, 1 corinthiens 11,
            1 corinthiens 12-13, 1 corinthiens 14, 1 corinthiens 15-16, 2 corinthiens 1-2, 2 corinthiens 3-4,
            2 corinthiens 5-6, 2 corinthiens 7-8, 2 corinthiens 9-10, 2 corinthiens 11, 2 corinthiens 12-13'
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
