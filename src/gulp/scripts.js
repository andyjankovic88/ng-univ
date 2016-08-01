'use strict';

var path = require('path');
var gulp = require('gulp');
var conf = require('./conf');

var browserSync = require('browser-sync');

var $ = require('gulp-load-plugins')();

gulp.task('scripts', ['checkScripts'], function () {
  return gulp.src(path.join(conf.paths.src, '/app/**/*.js'))
    .pipe(browserSync.reload({ stream: true }))
    .pipe($.size());
});
gulp.task('checkScripts', function() {
   return gulp.src([path.join(conf.paths.src, '/app/**/*.js'), path.join('!' + conf.paths.src, '/app/thirdPart/**/*.js')])
      .pipe($.jshint())
      .pipe($.jshint.reporter('jshint-stylish'));
});
