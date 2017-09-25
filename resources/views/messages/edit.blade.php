@extends(config('app.theme'))

@section('content')
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12" id="content">
          <form accept-charset="utf-8"
                action="{{ route('messages.update', $message->id) }}"
                id="edit-message"
                method="POST">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="mdc-textfield mdc-textfield--upgraded">
              <input autofocus
                     class="mdc-textfield__input"
                     id="title"
                     name="title"
                     type="text"
                     value="{{ $message->title }}">
              <label class="mdc-textfield__label mdc-textfield__label--float-above" for="title">
                Titre
              </label>
            </div>
            <div class="mdc-textfield">
              <input class="mdc-textfield__input"
                     id="message-passage"
                     name="passage"
                     type="text"
                     value="{{ $message->passage }}">
              <label class="mdc-textfield__label" for="message-passage">
                Passage
              </label>
            </div>
            <button class="mdc-button mdc-button--raised" type="submit">
              @lang('forms.edit_button')
            </button>
          </form>
@endsection
