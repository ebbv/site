@extends(config('app.theme'))

@section('content')
  <a class="mdc-button mdc-button--raised" href="bulletin/2023/juillet">
    <div class="mdc-button__ripple"></div>
    <span class="mdc-button__label">juillet</span>
  </a>
  <a class="mdc-button mdc-button--raised" href="bulletin/2023/aout">
    <div class="mdc-button__ripple"></div>
    <span class="mdc-button__label">août</span>
  </a>
  <a class="mdc-button mdc-button--raised" href="bulletin/2023/septembre">
    <div class="mdc-button__ripple"></div>
    <span class="mdc-button__label">septembre</span>
  </a>
  <a class="mdc-button mdc-button--raised" href="bulletin">
    <div class="mdc-button__ripple"></div>
    <span class="mdc-button__label">mois en cours</span>
  </a>
  <embed id="bulletin-iframe" type="application/pdf" src="{{ $url }}?generate"></embed>
@endsection
