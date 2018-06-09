          <div class="mdc-card">
            <section class="mdc-card__primary">
@isset ($type)
              <a href="{{ $message->path() }}">
@endif
                <h3>{{ $message->title }}</h3>
@isset ($type)
              </a>
@endif
            </section>
            <section class="mdc-card__secondary">
              <p>Passage : {{ $message->passage }}</p>
              <p>
                Apporté le {{ strftime("%e %B, %Y", strtotime($message->date)) }} par
                <a href="{{ $message->speaker->path() }}">
                  {{ $message->speaker->fullname }}
                </a>
              </p>
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
                          mdc-layout-grid__cell--align-middle"> <!-- vertical alignment -->
              </div>
              <audio buffered class="my-audio" preload="metadata">
                <source src="{{ Storage::url('audio/'.$message->url) }}.ogg" type="audio/ogg">
                <source src="{{ Storage::url('audio/'.$message->url) }}.mp3" type="audio/mpeg">
              </audio>
              <div class="mdc-layout-grid__cell
                          mdc-layout-grid__cell--span-4-tablet
                          mdc-layout-grid__cell--span-7-desktop
                          mdc-layout-grid__cell--align-middle"> <!-- vertical alignment -->
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
          </div>
