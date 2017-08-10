@extends(config('app.theme'))

@section('content')
        <div class="mdc-layout-grid__cell--span-12" id="content">
          @include('directory.admin.form')
@endsection
