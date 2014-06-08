<!doctype html>
<!--[if lt IE 9]><html class="oldie" lang="fr"><![endif]-->
<html class="no-js" lang="fr">
    <head>
        <meta charset="utf-8">
        <base href="{{ Request::root().'/' }}">
        <title>EBBV</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/app.css">
        <script src="js/vendor/modernizr-2.8.2.min.js"></script>
    </head>
    <body>
        <p id="browsehappy">Vous utilisez un navigateur <strong>ancien</strong>. Veuillez le <a href="http://browsehappy.com/">mettre à jour</a> pour une expérience améliorée.</p>

        <div id="wrapper">

            @include($theme.'header')

            <div id="main" class="row">
                <aside id="sidebar" class="medium-4 columns">

                </aside>

                <div id="content" class="medium-8 columns">

@yield('content')

                </div> <!-- end of the content div -->
            </div> <!-- end of the main div -->
        </div> <!-- end of the wrapper div -->

        @include($theme.'footer')

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-2.1.1.min.js"><\/script>')</script>
        <script src="js/foundation.min.js"></script>
        <script src="js/app.js"></script>

    </body>
</html>