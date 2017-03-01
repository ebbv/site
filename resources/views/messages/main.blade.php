@extends(config('app.theme'))

@section('aside')
        <aside id="sidebar" class="medium-4 columns">
          <div class="row">
            <p class="small-12 columns">
              Bienvenue sur le site de notre église. Nous sommes heureux de votre
              visite et de l'intéret que vous manifestez pour l'œuvre de Dieu.
              Ici nous vous proposons l'écoute des prédications qui sont apportées
              le dimanche matin. Notre désir est d'édifier l'Eglise de Christ, et
              ce par un enseignement fidèle à Dieu et sa Parole.
            </p>
          </div>
        </aside>

@stop

@section('content')
        <div id="content" class="medium-8 columns">
          <div class="row">
            <div class="small-12 columns" id="messages-table">
@foreach ($messages as $m)
              <div class="row message-info">
                <div class="small-12 medium-5 columns">
                  <p class="full-name">
                    <span class="last-name">{{ $m->speaker->last_name }}</span>, {{ $m->speaker->first_name }}
                  </p>
                  <p class="message-date">
@for (list($year, $month, $day) = explode('-', $m->date), $i = 0; $i < 1; $i++)
                    Apporté le {{ ltrim($day, '0').' '.trans('date.month_names')[ltrim($month, '0')].', '.$year }}
@endfor
                  </p>
                </div>
                <div class="medium-7 columns">
                  <p class="message-title">
                    <a download="{{ $m->title }}" href="{{ Storage::url('audio/'.$m->url) }}.mp3">{{ $m->title }}</a>
                  </p>
                  <p class="message-passage">{{ $m->passage }}</p>
                </div>
              </div>
              <div class="row player">
                <div class="small-1 medium-1 large-1 columns">
                  <span class="playtoggle"></span>
                </div>
                <div class="small-6 medium-7 large-8 columns">
                  <span class="gutter">
                    <span class="loading"></span>
                    <span class="handle ui-slider-handle"></span>
                  </span>
                </div>
                <div class="small-5 medium-4 large-3 columns text-center">
                  <span class="timeleft"></span>
                  <audio preload="metadata" buffered>
                    <source src="{{ Storage::url('audio/'.$m->url) }}.ogg" type="audio/ogg">
                    <source src="{{ Storage::url('audio/'.$m->url) }}.mp3" type="audio/mpeg">
                  </audio>
                </div>
              </div>
@endforeach
            </div>
          </div>

          <div class="text-center">
            {{ $messages->links() }}
          </div>
@stop
