@extends(config('app.theme'))

@php
$passages = 'psaumes 102-103, psaumes 104-105, psaume 106, psaumes 107-108, psaumes 109-112, psaumes 113-116, psaumes 117-118,
  psaume 119.1-32, psaume 119.33-64, psaume 119.65-96, psaume 119.97-128, psaume 119.129-160, psaume 119.161-176, psaumes 120-122,
  psaumes 123-126, psaumes 127-131, psaumes 132-135, psaumes 136-138, psaumes 139-141, psaumes 142-144, psaumes 145-146,
  psaumes 147-148, psaumes 149-150, proverbes 1-2, proverbes 3-4, proverbes 5-6, proverbes 7-8, proverbes 9-10, proverbes 11-12,
  proverbes 13-14, proverbes 15';
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
