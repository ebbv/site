<!doctype html>
<!--[if lt IE 9]><html class="oldie" lang="{{App::getlocale()}}"><![endif]-->
<html class="no-js" lang="{{App::getlocale()}}">
  <head>
    <meta charset="utf-8">
    <base href="{{ url('/') }}/">
    <title>{{ config('app.site_prefix').'EBBV' }}</title>
    <meta name="description" content="Le site de l'Eglise Biblique Baptiste de Vernon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/app.css">
  </head>
  <body>
    <p id="browsehappy">
      Vous utilisez un navigateur <strong>ancien</strong>.
      Veuillez le <a href="http://browsehappy.com/">mettre à jour</a> pour une expérience améliorée.
    </p>

    <div id="wrapper">
      @include($theme.'header')

      <div id="main" class="row">
@yield('aside')
@yield('content')
        </div> <!-- end of the content div -->
      </div> <!-- end of the main div -->
    </div> <!-- end of the wrapper div -->

    @include($theme.'footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/{{JQUERY_VERSION}}/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/vendor/jquery-ui.min.js"></script>
    <script src="js/vendor/foundation.min.js"></script>
    <script src="js/app.js"></script>

  </body>
</html>
