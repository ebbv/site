@extends(config('app.theme'))

@php
$passages = [
  'Exode 24-25', 'Exode 26-27', 'Exode 28', 'Exode 29', 'Exode 30-31', 'Exode 32-33',
  'Exode 34', 'Exode 35-36', 'Exode 37-38', 'Exode 39', 'Exode 40', 'Lévitique 1',
  'Lévitique 2-3', 'Lévitique 4', 'Lévitique 5-6', 'Lévitique 7', 'Lévitique 8-9',
  'Lévitique 10', 'Lévitique 11-12', 'Lévitique 13', 'Lévitique 14', 'Lévitique 15',
  'Lévitique 16', 'Lévitique 17-18', 'Lévitique 19', 'Lévitique 20-21', 'Lévitique 22',
  'Lévitique 23-24', 'Lévitique 25', 'Lévitique 26'
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
