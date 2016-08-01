(function () {
   "use strict";

   angular.module('helper')
      .directive('onLastRepeat', function () {
         return {
            restrict: 'A',
            link: function ($scope, elem, attrs) {
               if($scope.$last)
                  $scope.$applyAsync(function(self) {
                     self[attrs.onLastRepeat](elem);
                  });
            }
         }
      });


})();

