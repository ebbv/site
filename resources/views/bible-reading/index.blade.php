@extends(config('app.theme'))

@php
$passages = [
  '1 Samuel 1', '1 Samuel 2', '1 Samuel 3-4', '1 Samuel 5-6', '1 Samuel 7-8', '1 Samuel 9', '1 Samuel 10-11',
  '1 Samuel 12-13', '1 Samuel 14', '1 Samuel 15', '1 Samuel 16', '1 Samuel 17', '1 Samuel 18-19',
  '1 Samuel 20', '1 Samuel 21-22', '1 Samuel 23-24', '1 Samuel 25', '1 Samuel 26-27', '1 Samuel 28-29',
  '1 Samuel 30-31', '2 Samuel 1', '2 Samuel 2', '2 Samuel 3-4', '2 Samuel 5-6', '2 Samuel 7-8',
  '2 Samuel 9-10', '2 Samuel 11', '2 Samuel 12', '2 Samuel 13', '2 Samuel 14', '2 Samuel 15'
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
