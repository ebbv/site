var del = require('del');

var gulp = require('gulp');

var pkg = require('./package.json');

var plugins = require('gulp-load-plugins')();

var runSequence = require('run-sequence');


gulp.task('copy', function () {
  return gulp.src(['src/**', '!src/app/views/layouts/master.blade.php'], {dot:true})
  .pipe(gulp.dest('./'));
});

gulp.task('css', function () {
  return gulp.src(['node_modules/normalize.css/normalize.css', 'node_modules/foundation-sites/css/foundation.min.css'])
  .pipe(gulp.dest('public/css'));
});

gulp.task('js', function () {
  return gulp.src(['node_modules/jquery/dist/jquery.min.js', 'node_modules/foundation-sites/js/foundation.min.js'])
  .pipe(gulp.dest('public/js/vendor'));
});

gulp.task('template', function () {
  return gulp.src('src/app/views/layouts/master.blade.php')
  .pipe(plugins.replace(/{{JQUERY_VERSION}}/g, pkg.devDependencies.jquery))
  .pipe(gulp.dest('app/views/layouts'));
});

gulp.task('minify', function () {
  return gulp.src('public/css/*.css')
  .pipe(plugins.minifyCss({keepSpecialComments:0}))
  .pipe(gulp.dest('public/css'));
});

gulp.task('imgs', function () {
  return gulp.src('public/img/**')
  .pipe(plugins.imagemin({optimizationLevel:3, progressive:true, interlaced:true}))
  .pipe(gulp.dest('public/img'));
});

gulp.task('prep', function (done) {
  del([
    'app/*',
    '!app/storage',
    'bootstrap',
    'public/*',
    '!public/audio'
  ], done);
});

gulp.task('clean', function (done) {
  del([
    'public/css/*.css',
    '!public/css/app.css'
  ], done);
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
