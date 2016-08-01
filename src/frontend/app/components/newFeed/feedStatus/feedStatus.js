(function() {
   "use strict";

   angular.module('newFeed')
      .directive('feedStatus', function() {
         return {
            restrict: 'E',
            scope: {
               post: '='
            },
            templateUrl: '/app/components/newFeed/feedStatus/feedStatus.html',
            link: function ($scope, $elem, $attr) {
            }
         }
      });

})();
