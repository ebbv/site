@extends(config('app.theme'))

@php
$passages = 'proverbes 16-17, proverbes 18-19, proverbes 20-21, proverbes 22-23, proverbes 24, proverbes 25-26,
  proverbes 27-28, proverbes 29-30, proverbes 31, ecclesiaste 1-2, ecclesiaste 3-4, ecclesiaste 5-6,
  ecclesiaste 7-8, ecclesiaste 9-10, ecclesiaste 11-12, cantique des cantiques 1-3, cantique des cantiques 4-5,
  cantique des cantiques 6-8, esaie 1-2, esaie 3-4, esaie 5, esaie 6-7, esaie 8-9, esaie 10, esaie 11-12, esaie 13-14,
  esaie 15-17, esaie 18-19, esaie 20-21, esaie 22, esaie 23-24'
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
