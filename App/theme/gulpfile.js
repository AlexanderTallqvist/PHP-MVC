'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var pump = require('pump');


gulp.task('default', ['sass', 'sass:watch', 'compress', 'compress:watch']);

// Sass task
gulp.task('sass', function () {
  return gulp.src('./src/sass/styles.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('../../public/css'));
});

// JS task
gulp.task('compress', function (cb) {
  pump([
      gulp.src('./src/js/*.js'),
      uglify(),
      gulp.dest('../../public/js')
    ],
    cb
  );
});

// Watch scss and js changes
gulp.task('sass:watch', function () {
  gulp.watch('./src/sass/**/*.scss', ['sass']);
});

gulp.task('compress:watch', function () {
  gulp.watch('./src/js/**/*.js', ['compress']);
});
