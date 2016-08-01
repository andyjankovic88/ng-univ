(function() {
   'use strict';

   angular
      .module('connectionsRequests', [])
      .controller('requestsCtrl', function($scope, apiService, userService, dataShareService) {
         $scope.listConnectionsRequest = [];

         $scope.noConnections = false;
         $scope.connectionsData = dataShareService.connections;
         $scope.searchString = '';

         function init () {
            apiService.connections.requests(userService.getInfo().id).then(function (response) {
               if (angular.isArray(response.connections_requests) &&
                  response.connections_requests.length > 0) {

                  $scope.listConnectionsRequest = response.connections_requests;
               } else {
                  $scope.noConnections = true;
                  $scope.listConnectionsRequest = [];
               }
            }, function (err) {
               $scope.noConnections = true;
               $scope.listConnectionsRequest = [];
            });
         }

         $scope.acceptRequest = function ($index, followed) {
            apiService.connections.accept(userService.getInfo().id, followed).then(function (response) {
                $scope.listConnectionsRequest.splice($index,1);
            }, function (err) {
               console.log('-- Error on accepting connections --', err);
            });
         };

         $scope.blockRequest = function ($index, followed) {
            apiService.connections.block(userService.getInfo().id, followed).then(function (response) {
                $scope.listConnectionsRequest.splice($index,1);
            }, function (err) {
               console.log('-- Error on block connection request --', err);
            });
         };

         //$scope.$watch('connectionsData.searchString', function (newValue, oldValue) {
         //   // console.log(newValue);
         //});

         $scope.$on('doConnectionSearch', function (evt, searchString) {
            $scope.searchString = $scope.connectionsData.searchString;
         });

         init();
      });

})();
