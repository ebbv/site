@extends(config('app.theme'))

@section('content')
  <form accept-charset="utf-8" action="chants" method="POST">
    @csrf
    <label class="mdc-text-field mdc-text-field--outlined" id="song-title-textbox">
      <input autofocus name="title" class="mdc-text-field__input" value="{{ old('title') }}">
      <span class="mdc-notched-outline">
        <span class="mdc-notched-outline__leading"></span>
        <span class="mdc-notched-outline__notch">
          <span class="mdc-floating-label">Titre</span>
        </span>
        <span class="mdc-notched-outline__trailing"></span>
      </span>
    </label>
    <span class="divider-1-rem"></span>
    <label class="mdc-text-field mdc-text-field--outlined" id="song-number">
      <input min="0" name="number" type="number" class="mdc-text-field__input" value="{{ old('number') }}">
      <span class="mdc-notched-outline">
        <span class="mdc-notched-outline__leading"></span>
        <span class="mdc-notched-outline__notch">
          <span class="mdc-floating-label">Numéro</span>
        </span>
        <span class="mdc-notched-outline__trailing"></span>
      </span>
    </label>
    <button class="mdc-button mdc-button--raised" id="add-button" type="submit">
      <div class="mdc-button__ripple"></div>
      <span class="mdc-button__label">Ajouter</span>
    </button>
  </form>
@endsection
