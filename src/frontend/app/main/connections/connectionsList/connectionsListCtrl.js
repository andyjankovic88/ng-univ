(function() {
   'use strict';

   angular
      .module('connectionsList', [])
      .controller('connectionsListCtrl', function($scope, apiService, userService, dataShareService, alerts) {
         $scope.listConnections = null;

         $scope.noConnections = false;
         $scope.connectionsData = dataShareService.connections;
         $scope.searchString = '';

         function init () {
            $scope.loaderActive = true;
            apiService.connections.myconnections().then(function (response) {
               $scope.loaderActive = false;
               if (angular.isArray(response.connections) && response.connections.length > 0) {
                  $scope.listConnections = response.connections;
               } else {
                  $scope.noConnections = true;
                  $scope.listConnections = [];
               }
            }, function (err) {
               $scope.loaderActive = false;
               $scope.noConnections = true;
               $scope.listConnections = [];
            });
         }

         $scope.removeConnection = function ($index, followed) {
            alerts.confirm('Are you sure you want to remove connection?').then(function () {
               apiService.connections.close_connection(followed).then(function (response) {
                  $scope.listConnections.splice($index, 1);
               }, function (err) {
                  console.log('-- Error on close connection --', err);
               });
            })
         };


         $scope.$on('doConnectionSearch', function (evt, searchString) {
            $scope.searchString = $scope.connectionsData.searchString;
         });

         init();
      });

})();
