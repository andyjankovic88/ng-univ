(function() {
   'use strict';

   angular.module('newFeed')
      .directive('targetCategory', function() {
         return {
            restrict: 'E',
            scope: {
               title: '@',
               list: '='
            },
            templateUrl: '/app/components/newFeed/targetSelect/targetCategory/targetCategory.html',
            link: function($scope) {
               $scope.middle = function() {
                  return Math.ceil($scope.list.length / 2);
               };
               $scope.nMiddle = function() {
                  return -Math.ceil($scope.list / 2);
               };
            }
         };
      });
})();
