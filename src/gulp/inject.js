'use strict';

var path = require('path');
var gulp = require('gulp');
var conf = require('./conf');
var svgstore = require('gulp-svgstore');
var rename = require('gulp-rename');

var $ = require('gulp-load-plugins')();

var wiredep = require('wiredep').stream;
var _ = require('lodash');

gulp.task('inject', ['scripts', 'styles'], function () {
   var injectStyles = gulp.src([
      path.join(conf.paths.tmp, '/serve/app/**/*.css'),
      path.join('!' + conf.paths.tmp, '/serve/app/vendor.css')
   ], {read: false});

   var injectScripts = gulp.src([
      path.join(conf.paths.src, '/app/**/*.module.js'),
      path.join(conf.paths.src, '/app/**/*.js'),
      path.join('!' + conf.paths.src, '/app/**/*.spec.js'),
      path.join('!' + conf.paths.src, '/app/**/*.mock.js')
   ])
      .pipe($.angularFilesort()).on('error', conf.errorHandler('AngularFilesort'));

   var injectOptions = {
      ignorePath: [conf.paths.src, path.join(conf.paths.tmp, '/serve')],
      addRootSlash: true
   };

   //////   inject svg icons
   var svgs = gulp
      .src(path.join(conf.paths.src, '/svg/**/*.svg'), {base: path.join(conf.paths.src, '/svg')})
      .pipe(rename(function (path) {
         var name = path.dirname.split(path.sep);
         name.push(path.basename);
         path.basename = name.join('-');
      }))
      .pipe(svgstore({inlineSvg: true}));

   function fileContents(filePath, file) {
      return file.contents.toString();
   }

   ///////

   return gulp.src(path.join(conf.paths.src, '/*.html'))
      .pipe($.inject(injectStyles, injectOptions))
      .pipe($.inject(injectScripts, injectOptions))
      .pipe($.inject(svgs, {transform: fileContents}))
      .pipe(wiredep(_.extend({}, conf.wiredep)))
      .pipe(gulp.dest(path.join(conf.paths.tmp, '/serve')));
});
