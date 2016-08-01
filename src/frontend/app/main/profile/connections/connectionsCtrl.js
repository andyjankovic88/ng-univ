(function() {
   'use strict';

   angular
      .module('profile')
      .controller('profileConnectionsrCtrl', function($scope, userService, apiService, alerts) {
         var page = 0;

         $scope.listRequestInProgress = false;
         $scope.noMoreData = false;

         $scope.connections = [];

         $scope.loadNextPage = function() {
            $scope.listRequestInProgress = true;

            apiService.connections.getList($scope.userId, page).then(
               function (response) {
                 if(angular.isArray(response)) {
                    if (response.length > 0) {
                       $scope.connections = $scope.connections.concat(response);
                       page++;
                    } else {
                       $scope.noMoreData = true;
                    }
                    $scope.listRequestInProgress = false;
                 }
               }
            );
         };

         $scope.sendConnectRequest = function (user) {
            user.isConnecting = true;
            apiService.connections.connect(userService.getInfo().id, user.user_id).then(function (response) {
               user.sent_connection_request = true;
               user.isConnecting = false;
            }, function (err) {
               user.isConnecting = false;
               if (err && err.data && err.data.message) {
                  alerts.warning(err.data.message);
               }
            });
         };
      });


})();
