var gulp = require('gulp');

var plugins = require('gulp-load-plugins')();

gulp.task('copy', [
  'copy:jquery',
  'copy:normalize'
]);

gulp.task('copy:normalize', function () {
  return gulp.src('node_modules/normalize.css/normalize.css')
  .pipe(gulp.dest('public/css'));
});

gulp.task('copy:jquery', function () {
  return gulp.src('node_modules/jquery/dist/jquery.min.js')
  .pipe(gulp.dest('public/js/vendor'));
});

gulp.task('css', function () {
  return gulp.src('public/css/*.css')
  .pipe(plugins.minifyCss())
  .pipe(gulp.dest('public/css'));
});

gulp.task('js', function () {
  return gulp.src('public/js/*.js')
  .pipe(plugins.uglify())
  .pipe(gulp.dest('public/js'));
});

gulp.task('default', ['copy'], function () {
  gulp.start('css', 'js');
});
