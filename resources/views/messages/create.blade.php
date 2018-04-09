@extends(config('app.theme'))

@section('content')
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12" id="content">
          <form accept-charset="utf-8"
                action="{{ route('messages.store') }}"
                class="mdc-layout-grid"
                id="add-message"
                method="POST">
            {{ csrf_field() }}
            <div class="mdc-layout-grid__inner">
              <div class="mdc-layout-grid__cell
                          mdc-layout-grid__cell--span-5-tablet
                          mdc-layout-grid__cell--span-8-desktop
                          mdc-text-field">
                <input class="mdc-text-field__input"
                       id="title"
                       name="title"
                       required
                       type="text">
                <label class="mdc-floating-label" for="title">
                  Titre
                </label>
                <div class="mdc-line-ripple"></div>
              </div>
              <div class="mdc-layout-grid__cell
                          mdc-layout-grid__cell--span-3-tablet
                          mdc-layout-grid__cell--span-4-desktop">
                <div class="mdc-select">
                  <select class="mdc-select__native-control" id="speaker" name="speaker">
                    <!-- <option></option> -->
@foreach ($speakers as $s)
                    <option value="{{ $s->id }}">{{ $s->last_name }}, {{ $s->first_name }}</option>
@endforeach
                  </select>
                  <div class="mdc-select__bottom-line"></div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell
                          mdc-layout-grid__cell--span-4-tablet
                          mdc-layout-grid__cell--span-7-desktop
                          mdc-text-field">
                <input class="mdc-text-field__input"
                       id="message-passage"
                       name="passage"
                       required
                       type="text">
                <label class="mdc-floating-label" for="message-passage">
                  Passage
                </label>
                <div class="mdc-line-ripple"></div>
              </div>
              <div class="mdc-layout-grid__cell
                          mdc-layout-grid__cell--span-2-tablet
                          mdc-layout-grid__cell--span-3-desktop">
                <div class="mdc-select">
                  <select class="mdc-select__native-control" id="message-file" name="file">
                    <option default selected>Choisir un fichier...</option>
@foreach ($files as $f)
                    <option value="{{ $f }}">{{ $f }}</option>
@endforeach
                  </select>
                  <div class="mdc-select__bottom-line"></div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell
                          mdc-layout-grid__cell--span-2-tablet
                          mdc-layout-grid__cell--span-2-desktop">
                <button class="mdc-button mdc-button--raised" type="submit">
                  @lang('forms.add_button')
                </button>
              </div>
            </div>
          </form>
@endsection
