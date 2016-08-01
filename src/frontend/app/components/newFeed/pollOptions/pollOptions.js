(function() {
   'use strict';

   angular.module('newFeed')
      .directive('pollOptions', function(helper) {
         return {
            restrict: 'E',
            scope: {
               options: '=',
               newRow: '='
            },
            templateUrl: '/app/components/newFeed/pollOptions/pollOptions.html',
            link: function($scope) {

               //$scope.options = [];
               if ($scope.newRow) {
                  $scope.options.push(createOption(''));
               }

               $scope.removeOption = function(index) {
                  if($scope.options.length < 2) { // To Do: create warning - options count should be at least one
                     return;
                  } 
                  helper.removeElement($scope.options, index);
               };
               $scope.addOption = function() {
                  $scope.options.push(createOption(''));
               };
               $scope.focus = function(element) {
                  element.focus();
               };
               function createOption(text) {
                  return {
                     text: text
                  };
               }

            }
         };
      })
})();
