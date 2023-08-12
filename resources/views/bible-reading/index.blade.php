@extends(config('app.theme'))

@php
$passages = [
  'Genèse 31', 'Genèse 32-33', 'Genèse 34-35', 'Genèse 36', 'Genèse 37', 'Genèse 38', 'Genèse 39-40',
  'Genèse 41', 'Genèse 42', 'Genèse 43', 'Genèse 44-45', 'Genèse 46-47', 'Genèse 48-49', 'Genèse 50',
  'Exode 1-2', 'Exode 3', 'Exode 4', 'Exode 5-6', 'Exode 7', 'Exode 8', 'Exode 9', 'Exode 10-11',
  'Exode 12', 'Exode 13-14', 'Exode 15', 'Exode 16', 'Exode 17-18', 'Exode 19-20', 'Exode 21',
  'Exode 22', 'Exode 23'
]
@endphp

@section('content')
  <ol id="bible-reading">
@foreach ($passages as $passage)
    <li>
      <span>{{ $passage }}</span>
      <div>o</div>
    </li>
@endforeach
  </ol>
@endsection
