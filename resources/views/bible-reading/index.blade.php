@extends(config('app.theme'))

@php
$passages = [
  '2 Samuel 16-17', '2 Samuel 18', '2 Samuel 19', '2 Samuel 20', '2 Samuel 21', '2 Samuel 22', '2 Samuel 23',
  '2 Samuel 24', '1 Rois 1', '1 Rois 2', '1 Rois 3-4', '1 Rois 5-6', '1 Rois 7', '1 Rois 8', '1 Rois 9-10',
  '1 Rois 11', '1 Rois 12-13', '1 Rois 14', '1 Rois 15', '1 Rois 16-17', '1 Rois 18', '1 Rois 19-20', '1 Rois 21',
  '1 Rois 22', '2 Rois 1-2', '2 Rois 3-4', '2 Rois 5-6', '2 Rois 7', '2 Rois 8'
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
