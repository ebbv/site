@extends(config('app.theme'))

@section('content')
        <div id="content" class="medium-10 medium-centered columns">
          <div class="row" id="add-message">
            <form method="POST" action="{{ route('messages.store') }}" accept-charset="utf-8" class="small-12 columns">
              {{ csrf_field() }}
              <div class="row">
                <div class="medium-8 columns">
                  <label for="title">Titre :</label>
                  <input autofocus id="title" name="title" type="text" value="">
                </div>
                <div class="medium-4 columns">
                  <label for="speaker">Orateur :</label>
                  <select id="speaker" name="speaker">
                    <!-- <option></option> -->
@foreach ($speakers as $s)
                    <option value="{{ $s->id }}">{{ $s->last_name }}, {{ $s->first_name }}</option>
@endforeach
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="medium-6 columns">
                  <label for="message-passage">Passage :</label>
                  <input id="message-passage" name="passage" type="text" value="">
                </div>
                <div class="medium-3 columns">
                  <label for="message-file">Fichier :</label>
                  <select id="message-file" name="file">
@foreach ($files as $f)
                    <option value="{{ $f }}">{{ $f }}</option>
@endforeach
                  </select>
                </div>
                <div class="medium-3 columns">
                  <input class="button float-right" type="submit" value="@lang('forms.add_button')">
                </div>
              </div>
            </form>
          </div>
@endsection
