@extends(config('app.theme'))

@section('content')
          <form accept-charset="utf-8"
                action="{{ route('messages.store') }}"
                class="mdc-layout-grid__inner"
                id="add-message"
                method="POST">
            @csrf

            <div class="mdc-layout-grid__cell
                        mdc-layout-grid__cell--span-5-tablet
                        mdc-layout-grid__cell--span-8-desktop">
@error('title')
              <div class="error">
                Merci de bien vouloir indiquer un titre
              </div>
@enderror
              <div class="mdc-text-field">
                <input class="mdc-text-field__input"
                      id="title"
                      name="title"
                      required
                      type="text"
                      value="{{ old('title') }}">
                <label class="mdc-floating-label" for="title">
                  Titre
                </label>
                <div class="mdc-line-ripple"></div>
              </div>
            </div>
            <div class="mdc-layout-grid__cell
                        mdc-layout-grid__cell--span-3-tablet
                        mdc-layout-grid__cell--span-4-desktop">
@error('user_id')
              <div class="error">
                Merci de bien vouloir choisir un orateur
              </div>
@enderror
              <div class="mdc-select">
                <i class="mdc-select__dropdown-icon"></i>
                <select class="mdc-select__native-control" id="speaker" name="user_id" required>
                  <option disabled selected value=""></option>
@foreach ($speakers as $s)
                  <option {{ $s->id == old('user_id') ? 'selected ' : '' }}value="{{ $s->id }}">
                    {{ $s->last_name }}, {{ $s->first_name }}
                  </option>
@endforeach
                </select>
                <label class="mdc-floating-label" for="speaker">Prédicateur</label>
                <div class="mdc-line-ripple"></div>
              </div>
            </div>
            <div class="mdc-layout-grid__cell
                        mdc-layout-grid__cell--span-4-tablet
                        mdc-layout-grid__cell--span-7-desktop">
@error('passage')
              <div class="error">
                Merci de bien vouloir indiquer un passage
              </div>
@enderror
              <div class="mdc-text-field">
                <input class="mdc-text-field__input"
                        id="message-passage"
                        name="passage"
                        required
                        type="text"
                        value="{{ old('passage') }}">
                <label class="mdc-floating-label" for="message-passage">
                  Passage
                </label>
                <div class="mdc-line-ripple"></div>
              </div>
            </div>
            <div class="mdc-layout-grid__cell
                        mdc-layout-grid__cell--span-2-tablet
                        mdc-layout-grid__cell--span-3-desktop">
@error('date')
              <div class="error">
                Merci de bien vouloir choisir un fichier
              </div>
@enderror
              <div class="mdc-select">
                <i class="mdc-select__dropdown-icon"></i>
                <select class="mdc-select__native-control" id="message-file" name="date" required>
                  <option disabled selected value=""></option>
@foreach ($files as $f)
                  <option {{ $f == old('date') ? 'selected ' : '' }}value="{{ $f }}">{{ $f }}</option>
@endforeach
                </select>
                <label class="mdc-floating-label" for="message-file">Choisir un fichier</label>
                <div class="mdc-line-ripple"></div>
              </div>
            </div>
            <div class="mdc-layout-grid__cell
                        mdc-layout-grid__cell--span-2-tablet
                        mdc-layout-grid__cell--span-2-desktop">
              <button class="mdc-button mdc-button--raised" type="submit">
                @lang('forms.add_button')

              </button>
            </div>
          </form>
@endsection
