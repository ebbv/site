const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css', {
  includePaths: ['node_modules']
})
  .js('resources/js/app.js', 'public/js');

if (mix.inProduction()) {
  mix.disableNotifications();
}
