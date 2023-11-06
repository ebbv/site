@extends(config('app.theme'))

@php
$passages = [
  'Deutéronome 6', 'Deutéronome 7', 'Deutéronome 8', 'Deutéronome 9', 'Deutéronome 10-11',
  'Deutéronome 12-13', 'Deutéronome 14-15', 'Deutéronome 16-17', 'Deutéronome 18-19',
  'Deutéronome 20-21', 'Deutéronome 22', 'Deutéronome 23', 'Deutéronome 24-25', 'Deutéronome 26-27',
  'Deutéronome 28', 'Deutéronome 29-30', 'Deutéronome 31', 'Deutéronome 32', 'Deutéronome 33-34',
  'Josué 1-2', 'Josué 3-4', 'Josué 5-6', 'Josué 7', 'Josué 8', 'Josué 9', 'Josué 10', 'Josué 11-12',
  'Josué 13-14', 'Josué 15', 'Josué 16-17'
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
