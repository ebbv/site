@extends(config('app.theme'))

@php
$passages = 'Psaumes 12-16, Psaumes 17-18, Psaumes 19-21, Psaumes 22-24, Psaumes 25-28, Psaumes 29-30, Psaumes 31-32,
  Psaumes 33-34, Psaumes 35-36, Psaumes 37-38, Psaumes 39-41, Psaumes 42-44, Psaumes 45-48, Psaumes 49-50, Psaumes 51-54,
  Psaumes 55-58, Psaumes 59-61, Psaumes 62-66, Psaumes 67-68, Psaumes 69-70, Psaumes 71-72, Psaumes 73-75, Psaumes 76-77,
  Psaumes 78-79, Psaumes 80-83, Psaumes 84-87, Psaumes 88-89, Psaumes 90-93, Psaumes 94-96, Psaumes 97-101';
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
