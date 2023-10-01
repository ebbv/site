@extends(config('app.theme'))

@php
$passages = [
  'Lévitique 27', 'Nombres 1', 'Nombres 2', 'Nombres 3', 'Nombres 4', 'Nombres 5-6',
  'Nombres 7', 'Nombres 8-9', 'Nombres 10', 'Nombres 11-12', 'Nombres 13-14',
  'Nombres 15', 'Nombres 16-17', 'Nombres 18', 'Nombres 19-20', 'Nombres 21',
  'Nombres 22', 'Nombres 23-24', 'Nombres 25-26', 'Nombres 27-28', 'Nombres 29-30',
  'Nombres 31', 'Nombres 32', 'Nombres 33', 'Nombres 34', 'Nombres 35-36',
  'Deutéronome 1', 'Deutéronome 2', 'Deutéronome 3', 'Deutéronome 4', 'Deutéronome 5'
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
