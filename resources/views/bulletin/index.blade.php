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
  <a class="mdc-button mdc-button--raised" href="bulletin/2023/octobre">
    <div class="mdc-button__ripple"></div>
    <span class="mdc-button__label">octobre</span>
  </a>
  <a class="mdc-button mdc-button--raised" href="bulletin/2023/novembre">
    <div class="mdc-button__ripple"></div>
    <span class="mdc-button__label">novembre</span>
  </a>
  <a class="mdc-button mdc-button--raised" href="bulletin/2023/decembre">
    <div class="mdc-button__ripple"></div>
    <span class="mdc-button__label">décembre</span>
  </a>
  <a class="mdc-button mdc-button--raised" href="bulletin">
    <div class="mdc-button__ripple"></div>
    <span class="mdc-button__label">mois en cours</span>
  </a>
  <img alt="" id="bulletin-iframe" src="{{ $url }}?generate"></img>
@endsection
