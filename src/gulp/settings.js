'use strict';

var path = require('path');
var gulp = require('gulp');
var conf = require('./conf');
var util = require('gulp-util');
var fs = require('fs');

gulp.task('set', function () {
   if (util.env.server) {
      var server_str = 'background.ucroo.com.au',
          protocol = 'https';

      if (util.env.server !== true) {
         server_str = util.env.server;
      }
      if (util.env.unsafe === true) {
         protocol = 'http';
      }
      fs.writeFile(conf.paths.src + '/config.js', 'var BACKEND_SERVER = "' + protocol + '://' + server_str + '"');
      fs.writeFile(conf.paths.dist + '/config.js', 'var BACKEND_SERVER = "' + protocol + '://' + server_str + '"');

   }

});
