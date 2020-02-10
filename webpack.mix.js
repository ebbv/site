const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css', {
  sassOptions: {
    includePaths: ['node_modules']
  }
})
  .js('resources/js/app.js', 'public/js')
  .version();

if (mix.inProduction()) {
  mix.disableNotifications();
}
