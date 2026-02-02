@extends(config('app.theme'))

@php
$passages = '2 samuel 16-17, 2 samuel 18, 2 samuel 19, 2 samuel 20, 2 samuel 21, 2 samuel 22, 2 samuel 23, 2 samuel 24, 1 rois 1,
             1 rois 2, 1 rois 3-4, 1 rois 5-6, 1 rois 7, 1 rois 8, 1 rois 9-10, 1 rois 11, 1 rois 12-13, 1 rois 14, 1 rois 15,
             1 rois 16-17, 1 rois 18, 1 rois 19-20, 1 rois 21, 1 rois 22, 2 rois 1-2, 2 rois 3-4, 2 rois 5-6, 2 rois 7-8';
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
