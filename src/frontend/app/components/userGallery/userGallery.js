(function() {
   'use strict';

   angular
      .module('userGallery', [])
      .directive('userGallery', function() {
         return {
            restrict: 'E',
            scope: {
               list: '=',
               title: '@',
               nameKey: '@',
               idKey: '@',
               photoKey: '@',
               arrow: '@',
               limitTo: '@'
            },
            templateUrl: '/app/components/userGallery/userGallery.html',
            link: function($scope) {
               if(!$scope.limitTo) {
                  $scope.limitTo = 999;
               }
            }
         };
      });
})();
