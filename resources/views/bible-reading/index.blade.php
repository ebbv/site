@extends(config('app.theme'))

@php
$passages = 'nehemie 9, nehemie 10-11, nehemie 12-13, esther 1-2, esther 3-4, esther 5-7, esther 8-10, job 1-2, job 3-4, job 5-6,
             job 7-8, job 9-10, job 11-13, job 14-15, job 16-18, job 19-20, job 21, job 22-23, job 24-26, job 27-28, job 29-30,
             job 31-32, job 33, job 34-35, job 36--37, job 38, job 39-40, job 41-42, psaumes 1-5, psaumes 6-8, psaumes 9-11';
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
