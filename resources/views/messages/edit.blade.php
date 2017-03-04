@extends(config('app.theme'))

@section('content')
        <div id="content" class="medium-10 medium-centered columns">
          <div class="row" id="edit-message">
            <form method="POST" action="{{ route('messages.update', $message->id) }}" accept-charset="utf-8" class="small-12 columns">
              {{ method_field('PATCH') }}
              {{ csrf_field() }}
              <div class="row">
                <div class="medium-8 columns">
                  <label for="title">Titre :</label>
                  <input autofocus id="title" name="title" type="text" value="{{ $message->title }}">
                </div>
                <div class="medium-4 columns">
                  <label for="message-passage">Passage :</label>
                  <input id="message-passage" name="passage" type="text" value="{{ $message->passage }}">
                </div>
              </div>
              <input class="button float-right" type="submit" value="@lang('forms.edit_button')">
            </form>
          </div>
@endsection
