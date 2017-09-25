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
              <h1 class="mdc-card__title mdc-card__title--large">
                <a href="{{ route('messages.show', $m->id) }}">{{ $m->title }}</a>
              </h1>
              <h2 class="mdc-card__subtitle">Passage : {{ $m->passage }}</h2>
            </section>
            <section class="mdc-card__supporting-text">
              <p>
                Apporté le {{ utf8_encode(strftime("%e %B, %Y", strtotime($m->date))) }}
                par {{ $m->speaker->first_name.' '.$m->speaker->last_name }}
              </p>
            </section>
            <div class="mdc-layout-grid player">
              <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell
                            mdc-layout-grid__cell--span-1">
                  <i class="material-icons mdc-icon-toggle"
                     role="button"
                     aria-pressed="false"
                     data-mdc-auto-init="MDCIconToggle"
                     data-toggle-on='{"content": "pause", "cssClass": "audio-pause"}'
                     data-toggle-off='{"content": "play_arrow", "cssClass": "audio-play"}'>
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
                  <div role="progressbar" class="mdc-linear-progress">
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
            </div>
@can ('update', $m)
            <section class="mdc-card__actions message-actions">
              <a href="{{ route('messages.edit', $m->id) }}">
                <button class="material-icons mdc-button mdc-button--compact mdc-card__action">edit</button>
              </a>
              <form method="POST" action="{{ route('messages.destroy', $m->id) }}" accept-charset="utf-8">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button class="material-icons mdc-button mdc-button--compact mdc-card__action">delete</button>
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
            <button class="material-icons mdc-fab" aria-label="Add">
              <span class="mdc-fab__icon">
                add
              </span>
            </button>
          </a>
@endcan
@endsection
