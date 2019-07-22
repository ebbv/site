@extends(config('app.theme'))

@section('content')
          <form accept-charset="utf-8"
                action="{{ route('message.update', $message->id) }}"
                id="edit-message"
                method="POST">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="mdc-text-field">
              <input autofocus
                     class="mdc-text-field__input"
                     id="title"
                     name="title"
                     type="text"
                     value="{{ $message->title }}">
              <label class="mdc-floating-label" for="title">
                Titre
              </label>
              <div class="mdc-line-ripple"></div>
            </div>
            <div class="mdc-select">
              <i class="mdc-select__dropdown-icon"></i>
              <select class="mdc-select__native-control" id="speaker" name="user_id">
@foreach ($speakers as $s)
                <option{{ ($message->user_id === $s->id) ? ' selected' : '' }} value="{{ $s->id }}">{{ $s->last_name }}, {{ $s->first_name }}</option>
@endforeach
              </select>
              <label class="mdc-floating-label" for="speaker">Prédicateur</label>
              <div class="mdc-line-ripple"></div>
            </div>
            <div class="mdc-text-field">
              <input class="mdc-text-field__input"
                     id="message-passage"
                     name="passage"
                     type="text"
                     value="{{ $message->passage }}">
              <label class="mdc-floating-label" for="message-passage">
                Passage
              </label>
              <div class="mdc-line-ripple"></div>
            </div>
            <button class="mdc-button mdc-button--raised" type="submit">
              @lang('forms.edit_button')
            </button>
          </form>
@endsection
