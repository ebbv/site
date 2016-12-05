@extends(Config::get('app.theme'))

@section('content')
        <div id="content" class="small-12 columns">
          <ul class="row small-up-1 medium-up-2 large-up-3 directory-list">
@foreach ($members as $m)
            <li class="column">
              <ul class="vcard">
                <li class="fn"><h4><a href="@lang('nav.directory.url')/{{ $m->id }}/@lang('nav.actions.edit')"><span class="last-name">{{ $m->last_name }}</span>, {{ $m->first_name }}</a></h4></li>
                <li class="street-address">
                  {{ ($m->address->street_number != 0) ? $m->address->street_number.',' : '' }}
                  {{ $m->address->street_type }}
                  {{ $m->address->street_name }}
                </li>
                <li class="">{{ $m->address->street_complement }}</li>
                <li><span class="zip">{{ $m->address->zip }}</span> <span class="locality">{{ $m->address->city }}</span></li>
@foreach ($m->phones as $p)
                <li class="telephone">{{ $p->type }} : {{ $p->number }}</li>
@endforeach
@foreach ($m->emails as $key => $e)
                <li class="email">
@if ($key == 0)
                  Mail :
@else
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
@endif
                  {{ $e->address }}
                </li>
@endforeach
              </ul>
            </li>
@endforeach
          </ul>
@stop
