@extends(config('app.theme'))

@section('content')
  <div style="margin: 0 auto; max-width: 1118px">
@foreach (range(2023, $now->year) as $year)
    <div class="mdc-select mdc-select--outlined bulletin-select" style="margin-right: 10px; margin-bottom: 15px; max-width: 360px">
      <div class="mdc-select__anchor" aria-labelledby="year-{{ $year }}">
        <span class="mdc-notched-outline">
          <span class="mdc-notched-outline__leading"></span>
          <span class="mdc-notched-outline__notch">
            <span id="year-{{ $year }}" class="mdc-floating-label">{{ $year }}</span>
          </span>
          <span class="mdc-notched-outline__trailing"></span>
        </span>
        <span class="mdc-select__selected-text-container">
          <span id="year-{{ $year }}-selected-text" class="mdc-select__selected-text"></span>
        </span>
        <span class="mdc-select__dropdown-icon">
          <svg
              class="mdc-select__dropdown-icon-graphic"
              viewBox="7 10 10 5" focusable="false">
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
      </div>
      <div class="mdc-menu mdc-menu-surface mdc-select__menu">
        <ul class="mdc-deprecated-list">
          <li class="mdc-deprecated-list-item" aria-selected="true" data-value="" role="option">
            <span class="mdc-deprecated-list-item__ripple"></span>
          </li>
@foreach (range(0,11) as $key)
          @php $display = $now->year($year)->month(1)->addMonth($key)->isoFormat('MMMM');
          $link = url("bulletin/{$year}/".(strtr($display, ['é' => 'e', 'û' => 'u']))) @endphp
          <li class="mdc-deprecated-list-item {{ ($link == url()->current()) ? 'mdc-deprecated-list-item--selected' : '' }}" aria-selected="{{ ($link == url()->current()) ? 'true' : 'false' }}" data-value="{{ $link }}" role="option">
            <span class="mdc-deprecated-list-item__ripple"></span>
            <span class="mdc-deprecated-list-item__text">
              {{ $display }}
            </span>
          </li>
@endforeach
        </ul>
      </div>
      <input type="hidden" />
    </div>
@endforeach
  </div>
  <img alt="" id="bulletin-iframe" src="{{ $url }}?generate" />

@endsection
