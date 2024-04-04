@extends(config('app.theme'))

@php
$passages = [
  '2 Chroniques 1-2', '2 Chroniques 3-4', '2 Chroniques 5-6', '2 Chroniques 7-8', '2 Chroniques 9-10', '2 Chroniques 11-12',
  '2 Chroniques 13-14', '2 Chroniques 15-16', '2 Chroniques 17-18', '2 Chroniques 19-20', '2 Chroniques 21-22',
  '2 Chroniques 23-24', '2 Chroniques 25', '2 Chroniques 26-27', '2 Chroniques 28', '2 Chroniques 29', '2 Chroniques 30-31',
  '2 Chroniques 32-33', '2 Chroniques 34', '2 Chroniques 35-36', 'Esdras 1-2', 'Esdras 3-4', 'Esdras 5-6', 'Esdras 7-8',
  'Esdras 9-10', 'Néhémie 1-2', 'Néhémie 3', 'Néhémie 4-5', 'Néhémie 6-7', 'Néhémie 8'
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
