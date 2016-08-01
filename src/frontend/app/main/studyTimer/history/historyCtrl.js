(function() {
   'use strict';

   angular
      .module('studyTimer')
      .controller('historyCtrl', function($scope, apiService, alerts) {
         $scope.sessionsData = {};

         $scope.remove = function(key, session) {
            alerts.confirm('Are you sure you want to remove Study Timer?').then(function () {
               apiService.timer.removeSession(session.id).then(
                  function () {
                     var index = $scope.sessionsData[key].indexOf(session);
                     $scope.sessionsData[key].splice(index, 1);
                     if ($scope.sessionsData[key].length === 0) {
                        delete $scope.sessionsData[key];
                     }
                  }
               );
            })
         };

         var page = 1;

         $scope.listRequestInProgress = false;

         $scope.loadNextPage = function(reset) {
            $scope.listRequestInProgress = true;

            if (reset) {
               page = 1;
            }

            apiService.timer.getList(page).then(
               function(response) {
                  if (response.study_session_data && Object.keys(response.study_session_data).length) {
                     angular.extend($scope.sessionsData, response.study_session_data);
                     page++;
                     $scope.listRequestInProgress = false;
                  }
               }
            );
         };
         $scope.$on('addedSession', function (event, data) {
            $scope.loadNextPage(true);
         });
      })
      .filter("textDay", function() {
         return function(input) {
            return moment(input).calendar(null, {
               sameDay: '[Today]',
               nextDay: '[Tomorrow]',
               lastDay: '[Yesterday]',
               lastWeek: 'dddd Do MMMM YYYY',
               nextWeek: 'dddd Do MMMM YYYY',
               sameElse: 'dddd Do MMMM YYYY'
            });

         };
      });
})();
