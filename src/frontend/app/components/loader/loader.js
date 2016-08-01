(function() {
   "use strict";

   angular.module('loader', [])
      .directive('loader', function() {
         return {
            restrict: 'E',
            scope: {
               isActive: '=',
               position: '@'
            },
            template: '<div class="loader" ng-hide="!isActive"><div>U</div></div>',
            link: function($scope, element) {
               $scope.position = $scope.position || 'absolute';

               if ($scope.position === 'absolute') {
                  element.parent().css({
                     position: 'relative'
                  });
                  element.css({
                     position: 'absolute'
                  });
               }
               if ($scope.position && $scope.position != 'absolute') {
                  element.css({
                     position: 'relative'
                  });
               }
            }
         }
      });

})();
