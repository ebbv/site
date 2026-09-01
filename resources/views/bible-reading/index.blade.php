@extends(config('app.theme'))

@php
$passages = 'esaie 25-27, esaie 28-29, esaie 30-31, esaie 32-33, esaie 34-35, esaie 36, esaie 37, esaie 38-39, esaie 40,
             esaie 41-42, esaie 43, esaie 44, esaie 45-46, esaie 47-48, esaie 49-50, esaie 51-52, esaie 53-55, esaie 56-57,
             esaie 58-59, esaie 60-61, esaie 62-64, esaie 65, esaie 66, jeremie 1-2, jeremie 3, jeremie 4, jeremie 5-6,
             jeremie 7, jeremie 8, jeremie 9';
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
