@extends(config('app.theme'))

@php
$passages = 'sophonie 3, aggee 1-2, zacharie 1-3, zacharie 4-7, zacharie 8-9, zacharie 10-12, zacharie 13-14,
            malachie 1-2, malachie 3-4, matthieu 1-2, matthieu 3-4, matthieu 5, matthieu 6-7, matthieu 8,
            matthieu 9, matthieu 10, matthieu 11, matthieu 12, matthieu 13, matthieu 14-15, matthieu 16-17,
            matthieu 18, matthieu 19-20, matthieu 21, matthieu 22, matthieu 23, matthieu 24, matthieu 25,
            matthieu 26, matthieu 27, matthieu 28'
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
