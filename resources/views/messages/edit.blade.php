@extends(config('app.theme'))

@section('content')
          <form accept-charset="utf-8"
                action="{{ route('messages.update', $message->slug) }}"
                id="edit-message"
                method="POST">
            @method('PATCH')

            @csrf

            <div class="mdc-text-field mdc-text-field--filled">
              <span class="mdc-text-field__ripple"></span>
              <span class="mdc-floating-label" id="title">Titre</span>
              <input arialabelledby="title"
                      class="mdc-text-field__input"
                      name="title"
                      required
                      type="text"
                      value="{{ $message->title }}">
              <span class="mdc-line-ripple"></span>
            </div>
            <div class="mdc-select mdc-select--filled mdc-select--required">
              <div class="mdc-select__anchor"
                    role="button"
                    aria-haspopup="listbox"
                    aria-expanded="false"
                    aria-labelledby="speaker-label speaker-selected-text">
                <span class="mdc-select__ripple"></span>
                <span id="speaker-label" class="mdc-floating-label">Prédicateur</span>
                <span class="mdc-select__selected-text-container">
                  <span id="speaker-selected-text" class="mdc-select__selected-text"></span>
                </span>
                <span class="mdc-select__dropdown-icon">
                  <svg
                      class="mdc-select__dropdown-icon-graphic"
                      viewBox="7 10 10 5" focusable="false">
                    <polygon
                        class="mdc-select__dropdown-icon-inactive"
                        stroke="none"
                        fill-rule="evenodd"
                        points="7 10 12 15 17 10">
                    </polygon>
                    <polygon
                        class="mdc-select__dropdown-icon-active"
                        stroke="none"
                        fill-rule="evenodd"
                        points="7 15 12 10 17 15">
                    </polygon>
                  </svg>
                </span>
                <span class="mdc-line-ripple"></span>
              </div>
              <div class="mdc-menu mdc-menu-surface mdc-select__menu">
                <ul class="mdc-deprecated-list">
@foreach ($speakers as $s)
                  <li class="mdc-deprecated-list-item{{ ($message->user_id === $s->id) ? ' mdc-deprecated-list-item--selected' : '' }}" data-value="{{ $s->id }}">
                    <span class="mdc-deprecated-list-item__ripple"></span>
                    <span class="mdc-deprecated-list-item__text">
                      {{ $s->last_name }}, {{ $s->first_name }}
                    </span>
                  </li>
@endforeach
                </ul>
              </div>
              <input name="user_id" type="hidden" />
            </div>
            <div class="mdc-text-field mdc-text-field--filled">
              <span class="mdc-text-field__ripple"></span>
              <span class="mdc-floating-label" id="passage">Passage</span>
              <input arialabelledby="passage"
                      class="mdc-text-field__input"
                      name="passage"
                      required
                      type="text"
                      value="{{ $message->passage }}">
              <span class="mdc-line-ripple"></span>
            </div>
            <a class="mdc-button mdc-button--cancel mdc-button--raised" href="{{ $message->path() }}">@lang('forms.cancel_button')</a>
            <button class="mdc-button mdc-button--raised" type="submit">
              @lang('forms.edit_button')
            </button>
          </form>
@endsection
