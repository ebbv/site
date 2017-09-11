const { mix } = require('laravel-mix');

mix.sass('resources/assets/sass/app.scss', 'public/css', {
  includePaths: ['node_modules']
})
  .js('resources/assets/js/app.js', 'public/js');

if (mix.inProduction()) {
  mix.disableNotifications();
}
