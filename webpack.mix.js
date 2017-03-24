const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/assets/sass/app.scss', 'public/css', {
    includePaths: ['node_modules/foundation-sites/scss']
})
   .scripts('resources/assets/js/app.js', 'public/js/app.js')
   .copy([
        'node_modules/foundation-sites/dist/js/foundation.min.js',
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/jquery-ui/jquery-ui.min.js'
    ], 'public/js/vendor')
   .copy('bower_components/jquery-ui/themes/ui-lightness/images', 'public/css/images')
   .copy('resources/assets/imgs', 'public/imgs')
   .sourceMaps();

if (mix.config.inProduction) {
    mix.disableNotifications();
}
