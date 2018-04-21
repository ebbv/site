<!doctype html>
<html lang="{{ App::getlocale() }}">
  <head>
    <meta charset="utf-8">
    <base href="{{ url('/') }}/">
    <title>{{ config('app.site_prefix').'EBBV' }}</title>
    <meta name="description" content="Le site de l'Eglise Biblique Baptiste de Vernon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <link rel="stylesheet" href="css/app.css">
  </head>
  <body class="mdc-typography">
    @include($theme.'header')

    <main class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">
@yield('aside')
@yield('content')
        </div> <!-- end of the content div -->
      </div>
    </main>

    @include($theme.'footer')

    <script src="js/app.js"></script>
  </body>
</html>