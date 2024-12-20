@extends(config('app.theme'))

@php
$passages = 'ezechiel 43-44, ezechiel 45-46, ezechiel 47, ezechiel 48, daniel 1-2, daniel 3, daniel 4,
            daniel 5-6, daniel 7-8, daniel 9-10, daniel 11-12, osee 1-2, osee 3-5, osee 6-8, osee 9-11,
            osee 12-14, joel 1-2, joel 3, amos 1-2, amos 3-4, amos 5-6, amos 7-9, abdias 1, jonas 1-2,
            jonas 3-4, michee 1-2, michee 3-5, michee 6-7, nahum 1-3, habakuk 1-3, sophonie 1-2'
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
