var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.css.sass.pluginOptions.includePaths = './node_modules/foundation-sites/scss/';

elixir(function(mix) {
    mix.sass([
        'app.scss'
    ])
    .scripts('app.js', 'public/js/app.js')
    .copy([
        'node_modules/foundation-sites/dist/foundation.min.js',
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/jquery-ui/jquery-ui.min.js'
    ], 'public/js/vendor')
    .copy('bower_components/jquery-ui/themes/ui-lightness/images', 'public/css/images')
    .copy('resources/assets/imgs', 'public/imgs');
});
