@extends(config('app.theme'))

@php
$passages = [
  '2 Rois 9', '2 Rois 10', '2 Rois 11-12', '2 Rois 13-14', '2 Rois 15-16', '2 Rois 17', '2 Rois 18', '2 Rois 19',
  '2 Rois 20-21', '2 Rois 22', '2 Rois 23', '2 Rois 24-25', '1 Chroniques 1', '1 Chroniques 2', '1 Chroniques 3-4',
  '1 Chroniques 5-6', '1 Chroniques 7', '1 Chroniques 8', '1 Chroniques 9', '1 Chroniques 10-11', '1 Chroniques 12-13',
  '1 Chroniques 14-15', '1 Chroniques 16-17', '1 Chroniques 18-19', '1 Chroniques 20-21', '1 Chroniques 22-23',
  '1 Chroniques 24-25', '1 Chroniques 26', '1 Chroniques 27', '1 Chroniques 28', '1 Chroniques 29'
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
