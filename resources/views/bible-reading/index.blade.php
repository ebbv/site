@extends(config('app.theme'))

@php
$passages = [
  'Josué 18', 'Josué 19', 'Josué 20-21', 'Josué 22', 'Josué 23-24', 'Juges 1', 'Juges 2-3',
  'Juges 4-5', 'Juges 6', 'Juges 7-8', 'Juges 9', 'Juges 10-11', 'Juges 12-13', 'Juges 14',
  'Juges 15', 'Juges 16', 'Juges 17-18', 'Juges 19', 'Juges 20', 'Juges 21', 'Esaïe 9.1-6',
  'Matthieu 1', 'Matthieu 2', 'Luc 1.1-22', 'Luc 1.23-56', 'Luc 1.57-80', 'Luc 2', 'Jean 1.1-18',
  'Ruth 1', 'Ruth 2', 'Ruth 3-4'
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
