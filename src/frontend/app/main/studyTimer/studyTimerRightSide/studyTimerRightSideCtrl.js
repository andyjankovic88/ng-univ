(function() {
   'use strict';

   angular
      .module('studyTimer')
      .controller('studyTimerRightSideCtrl', function($scope, apiService) {
         $scope.session = {};
         $scope.subjects = [];
         $scope.times = {};

         apiService.subjects.getList().then(function(response){
            $scope.subjects = response;
         });
         apiService.timer.getTimes().then(function(response){
            $scope.times = response;
         });

         $scope.submit = function() {
            apiService.timer.addSession($scope.session).then(function(response){
               $scope.session = {};
               $scope.$parent.$broadcast('addedSession', 'Session was added');
            });
         }
      });
})();
