(function() {
   'use strict';

   angular.module('scrollbar', [])
      .directive('scrollbar', function() {
         return {
            restrict: 'A',
            wheelSpeed: '=',
            wheelPropagation: '=',
            minScrollbarLength: '=',
            link: function($scope, element) {

               Ps.initialize(element[0]);

            }
         };
      })
})();
