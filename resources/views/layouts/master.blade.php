<!doctype html>
<html lang="{{ App::getlocale() }}">
  <head>
    <meta charset="utf-8">
    <base href="{{ url('/') }}/">
    <title>{{ config('app.prefix').'EBBV' }}</title>
    <meta name="description" content="Le site de l'Eglise Biblique Baptiste de Vernon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preload" href="fonts/vendor/material-design-icons/iconMaterialIcons-Regular.woff2?570eb83859dc23dd0eec423a49e147fe" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  </head>
  <body class="mdc-typography">

    @include($theme.'header')

    <div class="mdc-drawer-scrim"></div>
    <main class="mdc-layout-grid mdc-top-app-bar--fixed-adjust">
      <div class="mdc-layout-grid__inner">
@yield('aside')
@section('content-wrapper')
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12" id="content">
@show
@yield('content')
@section('end-div')
        </div> <!-- end of the content div -->
@show
      </div>
    </main>

    @include($theme.'footer')

    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>