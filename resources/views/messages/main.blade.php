@extends(config('app.theme'))

@section('aside')
        <aside class="mdc-layout-grid__cell
                      mdc-layout-grid__cell--span-3-tablet
                      mdc-layout-grid__cell--span-4-desktop"
               id="sidebar">
          <p>
            @lang('main.welcome')
          </p>
        </aside>

@endsection

@section('content')
        <div class="mdc-layout-grid__cell
                    mdc-layout-grid__cell--span-5-tablet
                    mdc-layout-grid__cell--span-8-desktop
                    message-cards"
             id="content">
@foreach ($messages as $m)
          <div class="mdc-card">
            <section class="mdc-card__primary">
              <a href="{{ route('messages.show', $m->id) }}">
                <h1>{{ $m->title }}</h1>
              </a>
            </section>
            <section class="mdc-card__secondary">
              <h3>Passage : {{ $m->passage }}</h3>
              <h3>
                Apporté le {{ utf8_encode(strftime("%e %B, %Y", strtotime($m->date))) }}
                par {{ $m->speaker->first_name.' '.$m->speaker->last_name }}
              </h3>
            </section>
            <div class="mdc-layout-grid__inner player js-player">
              <div class="mdc-layout-grid__cell
                          mdc-layout-grid__cell--span-1">
                <i aria-pressed="false"
                   class="material-icons mdc-icon-toggle"
                   data-mdc-auto-init="MDCIconToggle"
                   data-toggle-on='{"content": "pause", "cssClass": "audio-pause"}'
                   data-toggle-off='{"content": "play_arrow", "cssClass": "audio-play"}'
                   role="button">
                </i>
              </div>
              <div class="duration
                          mdc-layout-grid__cell
                          mdc-layout-grid__cell--span-3-phone
                          mdc-layout-grid__cell--span-3-tablet
                          mdc-layout-grid__cell--span-4-desktop
                          mdc-layout-grid__cell--align-middle">
              </div>
              <audio buffered class="my-audio" preload="metadata">
                <source src="{{ Storage::url('audio/'.$m->url) }}.ogg" type="audio/ogg">
                <source src="{{ Storage::url('audio/'.$m->url) }}.mp3" type="audio/mpeg">
              </audio>
              <div class="mdc-layout-grid__cell
                          mdc-layout-grid__cell--span-4-tablet
                          mdc-layout-grid__cell--span-7-desktop
                          mdc-layout-grid__cell--align-middle">
                <div class="mdc-linear-progress" role="progressbar">
                  <div class="mdc-linear-progress__buffering-dots"></div>
                  <div class="mdc-linear-progress__buffer"></div>
                  <div class="mdc-linear-progress__bar mdc-linear-progress__primary-bar">
                    <span class="mdc-linear-progress__bar-inner"></span>
                  </div>
                  <div class="mdc-linear-progress__bar mdc-linear-progress__secondary-bar">
                    <span class="mdc-linear-progress__bar-inner"></span>
                  </div>
                </div>
              </div>
            </div>
@can ('update', $m)
            <section class="mdc-card__actions message-actions">
              <a href="{{ route('messages.edit', $m->id) }}">
                <i class="material-icons mdc-card__action mdc-card__action-icon" role="button">edit</i>
              </a>
              <form accept-charset="utf-8" action="{{ route('messages.destroy', $m->id) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <i class="cancel material-icons mdc-card__action mdc-card__action-icon" role="button">delete</i>
              </form>
            </section>
@endcan
          </div>
@endforeach

          <div>
            {{ $messages->links() }}
          </div>
@can ('create', App\Models\Message::class)
          <a href="{{ route('messages.create') }}">
            <button aria-label="Add" class="material-icons mdc-fab">
              <span class="mdc-fab__icon">
                add
              </span>
            </button>
          </a>
@endcan
@endsection
