@extends(config('app.theme'))

@section('content')
        <div id="content" class="small-12 columns">
          <form id="directory-form" method="POST" action="@lang('nav.directory.url')" accept-charset="utf-8">
            @include('directory.admin.form')
          </form>
@stop
