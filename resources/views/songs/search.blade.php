@extends(config('app.theme'))

@section('content')
<div>
  <form accept-charset="utf-8" method="GET">
    <label class="mdc-text-field mdc-text-field--outlined" style="width: 100px">
      <input min="0" name="num" style="text-align: center" type="number" class="mdc-text-field__input" value="{{ request()->query('num') }}">
      <span class="mdc-notched-outline">
        <span class="mdc-notched-outline__leading"></span>
        <span class="mdc-notched-outline__notch">
          <span class="mdc-floating-label">Numéro</span>
        </span>
        <span class="mdc-notched-outline__trailing"></span>
      </span>
    </label>
    dans
    <div class="mdc-select mdc-select--outlined">
      <input type="hidden" name="recueil">
      <div class="mdc-select__anchor">
        <span class="mdc-select__selected-text"></span>
        <span class="mdc-select__dropdown-icon">
          <svg
              class="mdc-select__dropdown-icon-graphic"
              viewBox="7 10 10 5">
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
        <span class="mdc-notched-outline">
          <span class="mdc-notched-outline__leading"></span>
          <span class="mdc-notched-outline__notch">
            <span class="mdc-floating-label">Recueil</span>
          </span>
          <span class="mdc-notched-outline__trailing"></span>
        </span>
      </div>
      <div class="mdc-select__menu mdc-menu mdc-menu-surface" role="listbox">
        <ul class="mdc-list">
@foreach (\App\Songbook::all() as $book)
          <li aria-selected="true" class="mdc-list-item mdc-list-item--selected" data-value="{{ $book->id }}" role="option" tabindex="0">
            <span class="mdc-list-item__ripple"></span>
            <span class="mdc-list-item__text">{{ $book->title }}</span>
          </li>
@endforeach
        </ul>
      </div>
    </div>
    <button class="mdc-button mdc-button--raised" type="submit">
      <div class="mdc-button__ripple"></div>
      <span class="mdc-button__label">Rechercher</span>
    </button>
  </form>
@if ($song)
  <div>
    <p>
      {{ $song->songbooks->first()->pivot->number }} : {{ $song->title }}</p>
    <p>Ce chant a été choisi <strong>{{ $song->dates_count }}</strong> fois</p>
    <ul>
@foreach ($song->dates->pluck('date') as $date)
      <li>Le {{ strftime("%A %e %B, %Y", strtotime($date)) }}</li>
@endforeach
    </ul>
  </div>
@elseif (request()->filled('num'))
  <p>Ce chant n'a pas encore été choisi</p>
@endif
</div>
@endsection
