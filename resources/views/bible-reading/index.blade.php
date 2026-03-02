@extends(config('app.theme'))

@php
$passages = '2 rois 9, 2 rois 10, 2 rois 11-12, 2 rois 13-14, 2 rois 15-16, 2 rois 17, 2 rois 18, 2 rois 19, 2 rois 20-21,
             2 rois 22, 2 rois 23, 2 rois 24-25, 1 chroniques 1, 1 chroniques 2, 1 chroniques 3-4, 1 chroniques 5-6, 1 chroniques 7,
             1 chroniques 8, 1 chroniques 9, 1 chroniques 10-11, 1 chroniques 12-13, 1 chroniques 14-15, 1 chroniques 16-17, 1 chroniques 18-19,
             1 chroniques 20-21, 1 chroniques 22-23, 1 chroniques 24-25, 1 chroniques 26, 1 chroniques 27, 1 chroniques 28, 1 chroniques 29';
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
