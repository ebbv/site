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
                Apporté le {{ $message->formattedDate }} par
                  {{ $message->speaker->fullName }}
              </p>
            </section>
            <div class="mdc-layout-grid__inner player js-player">
              <div class="mdc-layout-grid__cell
                          mdc-layout-grid__cell--span-1">
                <button aria-hidden="true"
                        aria-label="Play and pause"
                        aria-pressed="false"
                        class="mdc-icon-button">
                  <i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">pause</i>
                  <i class="material-icons mdc-icon-button__icon">play_arrow</i>
                </button>
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
