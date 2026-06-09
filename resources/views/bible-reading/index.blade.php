@extends(config('app.theme'))

@php
$passages = 'psaumes 12-16, psaumes 17-18, psaumes 19-21, psaumes 22-24, psaumes 25-28, psaumes 29-30, psaumes 31-32, psaumes 33-34,
             psaumes 35-36, psaumes 37-38, psaumes 39-41, psaumes 42-44, psaumes 45-48, psaumes 49-50, psaumes 51-54, psaumes 55-58,
             psaumes 59-61, psaumes 62-66, psaumes 67-68, psaumes 69-70, psaumes 71-72, psaumes 73-75, psaumes 76-77, psaumes 78-79,
             psaumes 80-83, psaumes 84-87, psaumes 88-89, psaumes 90-93, psaumes 94-96, psaumes 97-101';
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
