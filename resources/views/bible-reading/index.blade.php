@extends(config('app.theme'))

@php
$passages = 'josue 18, josue 19, josue 20-21, josue 22, josue 23-24, juges 1, juges 2-3, juges 4-5, juges 6, juges 7-8,
            juges 9, juges 10-11, juges 12-13, juges 14, juges 15, juges 16, juges 17-18, juges 19, juges 20, juges 21,
            esaie 9.1-6, matthieu 1, matthieu 2, luc 1.1-22, luc 1.23-56, luc 1.57-80, luc 2, jean 1.1-18, ruth 1, ruth 2, ruth 3-4';
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
