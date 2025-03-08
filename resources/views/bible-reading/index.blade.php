@extends(config('app.theme'))

@php
$passages = 'luc  19-20, luc 21, luc 22, luc 23, luc 24, jean 1-2, jean 3, jean 4, jean 5, jean 6,
            jean 7-8, jean 9-10, jean 11, jean 12, jean 13-14, jean 15-16, jean 17-18, jean 19,
            jean 20-21, actes 1-2, actes 3-4, actes 5-6, actes 7, actes 8-9, actes 10, actes 11-12,
            actes 13, actes 14-15, actes 16, actes 17-18, actes 19'
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
