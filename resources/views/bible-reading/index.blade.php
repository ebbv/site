@extends(config('app.theme'))

@php
$passages = '2 chroniques 1-2, 2 chroniques 3-4, 2 chroniques 5-6, 2 chroniques 7-8, 2 chroniques 9-10, 2 chroniques 11-12,
             2 chroniques 13-14, 2 chroniques 15-16, 2 chroniques 17-18, 2 chroniques 19-20, 2 chroniques 21-22, 2 chroniques 23-24,
             2 chroniques 25, 2 chroniques 26-27, 2 chroniques 28, 2 chroniques 29, 2 chroniques 30-31, 2 chroniques 32-33, 2 chroniques 34,
             2 chroniques 35-36, esdras 1-2, esdras 3-4, esdras 5-6, esdras 7-8, esdras 9-10, nehemie 1-2, nehemie 3, nehemie 4-5, nehemie 6-7, nehemie 8';
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
