var del = require('del');

var gulp = require('gulp');

var pkg = require('./bower.json');

var plugins = require('gulp-load-plugins')();

var runSequence = require('run-sequence');


gulp.task('copy', function () {
  return gulp.src(['src/**', '!src/bootstrap/cache', '!src/resources/views/layouts/master.blade.php'], {dot:true})
  .pipe(gulp.dest('./'));
});

gulp.task('css', function () {
  return gulp.src([
    'node_modules/foundation-sites/dist/foundation.min.css',
    'bower_components/jquery-ui/themes/ui-lightness/jquery-ui.min.css',
    'bower_components/jquery-ui/themes/ui-lightness/**',
    'node_modules/normalize.css/normalize.css'
  ])
  .pipe(gulp.dest('public/css'));
});

gulp.task('js', function () {
  return gulp.src([
    'node_modules/foundation-sites/dist/foundation.js',
    'bower_components/jquery/dist/jquery.js',
    'bower_components/jquery-ui/jquery-ui.js'
  ])
  .pipe(plugins.rename(function (path) {
    path.basename += ".min";
  }))
  .pipe(plugins.uglify())
  .pipe(gulp.dest('public/js/vendor'));
});

gulp.task('template', function () {
  return gulp.src('src/resources/views/layouts/master.blade.php')
  .pipe(plugins.replace(/{{JQUERY_VERSION}}/g, pkg.dependencies.jquery))
  .pipe(gulp.dest('resources/views/layouts'));
});

gulp.task('minify', function () {
  return gulp.src('public/css/*.css')
  .pipe(plugins.cleanCss({keepSpecialComments:0}))
  .pipe(gulp.dest('public/css'));
});

gulp.task('imgs', function () {
  return gulp.src('public/img/**')
  .pipe(plugins.imagemin({optimizationLevel:3, progressive:true, interlaced:true}))
  .pipe(gulp.dest('public/img'));
});

gulp.task('prep', (done) => {
  del([
    'app',
    'bootstrap/*',
    '!bootstrap/cache',
    'config',
    'database',
    'public/*',
    '!public/audio',
    'resources',
    'tests'
  ]).then( () => {
      done();
  });
});

gulp.task('clean', (done) => {
  del([
    'public/css/*.css',
    '!public/css/app.css'
  ]).then( () => {
      done();
  });
});

gulp.task('build', function (done) {
  runSequence(
    'prep',
    'copy',
    'css',
    'js',
    'template',
    'minify',
    'imgs',
    'clean',
  done)
});

gulp.task('default', ['build']);
