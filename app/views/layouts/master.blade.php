<!doctype html>
<!--[if lt IE 9]><html class="oldie" lang="fr"><![endif]-->
<html class="no-js" lang="fr">
    <head>
        <meta charset="utf-8">
        <base href="{{ Request::root().'/' }}">
        <title>EBBV</title>
        <meta name="description" content="Le site de l'Eglise Biblique Baptiste de Vernon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/app.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <p id="browsehappy">Vous utilisez un navigateur <strong>ancien</strong>. Veuillez le <a href="http://browsehappy.com/">mettre à jour</a> pour une expérience améliorée.</p>

        <div id="wrapper">

            @include($theme.'header')

            <div id="main" class="row">
                <aside id="sidebar" class="medium-4 columns">
                    <div class="row">
                        <p class="small-12 columns">
                            Bienvenue sur le site de notre église. Nous sommes heureux de votre visite et de l'intéret que vous manifestez pour l'œuvre de Dieu. Ici nous vous proposons l'écoute des prédications qui sont apportées le dimanche matin. Notre désir est d'édifier l'Eglise de Christ, et ce par un enseignement fidèle à Dieu et sa Parole.
                        </p>
                    </div>
                </aside>

                <div id="content" class="medium-8 columns">

@yield('content')

                </div> <!-- end of the content div -->
            </div> <!-- end of the main div -->
        </div> <!-- end of the wrapper div -->

        @include($theme.'footer')

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-2.1.1.min.js"><\/script>')</script>
        <!-- //-beg- concat_js -->
        <script src="js/vendor/jquery-ui-1.11.2.min.js"></script>
        <script src="js/foundation.min.js"></script>
        <script src="js/app.js"></script>
        <!-- //-end- concat_js -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-{{ Config::get('app.ga_key') }}','auto');ga('send','pageview');
        </script>

    </body>
</html>