(function() {

   'use strict';

   angular
      .module('firstSteps')
      .controller('firstStepsStaffCtrl', function($scope, apiFirstSteps, $http) {
         $scope.items = [];
         $scope.loaderActive = true;
         apiFirstSteps.getStaffList().then(
            function (response) {
               $scope.steps = response.steps;
               $scope.loaderActive = false;
            },
            function () {
               $scope.loaderActive = false;
            }
         );
         $scope.completeStaffStep = function (link) {
            apiFirstSteps.completeStaffStep(link);
         }
      });


})();
