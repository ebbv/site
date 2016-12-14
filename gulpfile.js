var elixir = require('laravel-elixir');

var gulp = require('gulp');

var pkg = require('./bower.json');

var rename = require('gulp-rename');

var replace = require('gulp-replace');


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

gulp.task('jquery-replace', function () {
  return gulp.src('resources/views/layouts/shadow.blade.php')
  .pipe(rename(function (path) {
      path.basename = 'master.blade';
  }))
  .pipe(replace(/{{JQUERY_VERSION}}/g, pkg.dependencies.jquery))
  .pipe(gulp.dest('resources/views/layouts'));
});

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
    .copy('resources/assets/imgs', 'public/imgs')
    .task('jquery-replace');
});
