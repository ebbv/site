@extends(config('app.theme'))

@section('content')
<div>
  <form accept-charset="utf-8" action="cultes" method="POST">
    @csrf
    <input name="date" type="date">
@foreach (range(0, 4) as $item)
    <div class="mdc-select mdc-select--outlined">
      <input type="hidden" name="songs[]">
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
            <span class="mdc-floating-label">Chant</span>
          </span>
          <span class="mdc-notched-outline__trailing"></span>
        </span>
      </div>
      <div class="mdc-select__menu mdc-menu mdc-menu-surface" role="listbox">
        <ul class="mdc-list">
          <li aria-selected="false" class="mdc-list-item" data-value="" role="option" tabindex="-1">
            <span class="mdc-list-item__ripple"></span>
          </li>
@foreach ($songs as $song)
          <li aria-selected="false" class="mdc-list-item" data-value="{{ $song->id }}" role="option" tabindex="-1">
            <span class="mdc-list-item__ripple"></span>
            <span class="mdc-list-item__text">{{ "{$song->pivot->number} : {$song->title}" }}</span>
          </li>
@endforeach
        </ul>
      </div>
    </div>
@endforeach
    <button class="mdc-button mdc-button--raised" type="submit">
      <div class="mdc-button__ripple"></div>
      <span class="mdc-button__label">Ajouter</span>
    </button>
  </form>
</div>
@endsection
