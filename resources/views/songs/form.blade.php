@extends(config('app.theme'))

@section('content')
  <form accept-charset="utf-8" action="chants" method="POST">
    @csrf
    <label class="mdc-text-field mdc-text-field--outlined" style="width: 350px">
      <input autofocus name="title" class="mdc-text-field__input" value="{{ old('title') }}">
      <span class="mdc-notched-outline">
        <span class="mdc-notched-outline__leading"></span>
        <span class="mdc-notched-outline__notch">
          <span class="mdc-floating-label">Titre</span>
        </span>
        <span class="mdc-notched-outline__trailing"></span>
      </span>
    </label>
    <label class="mdc-text-field mdc-text-field--outlined" style="width: 100px">
      <input min="0" name="number" style="text-align: center" type="number" class="mdc-text-field__input" aria-labelledby="my-label-id" value="{{ old('number') }}">
      <span class="mdc-notched-outline">
        <span class="mdc-notched-outline__leading"></span>
        <span class="mdc-notched-outline__notch">
          <span class="mdc-floating-label">Numéro</span>
        </span>
        <span class="mdc-notched-outline__trailing"></span>
      </span>
    </label>
    <button class="mdc-button mdc-button--raised" type="submit">
      <div class="mdc-button__ripple"></div>
      <span class="mdc-button__label">Ajouter</span>
    </button>
  </form>
@endsection
