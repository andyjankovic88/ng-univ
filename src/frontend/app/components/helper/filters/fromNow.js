(function() {
   "use strict";

   angular.module('helper')
      .filter('fromNow', function() {
         return function(input) {
            return moment(input).fromNow();
         };
      });

})();
