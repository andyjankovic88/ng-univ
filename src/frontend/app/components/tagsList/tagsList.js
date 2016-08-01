(function() {
   'use strict';

   angular
      .module('tagsList', [])
      .directive('tagsList', function() {
         return {
            restrict: 'E',
            scope: {
               list: '=',
            },
            templateUrl: '/app/components/tagsList/tagsList.html'            
         };
      });
})();
