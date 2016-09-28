@extends(Config::get('app.theme'))

@section('content')
        <div id="content" class="small-12 columns">
          <form id="directory-form" method="POST" action="annuaire" accept-charset="utf-8">
            @include('directory.form')
          </form>
@stop
