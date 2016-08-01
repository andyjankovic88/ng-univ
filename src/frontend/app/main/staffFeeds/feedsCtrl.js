(function () {
   'use strict';

   angular
      .module('staffFeeds', [])
      .controller('staffFeedsCtrl', function ($scope, apiService, userService) {
         $scope.feedId = userService.getUnivInfo().id;
         $scope.doFeedSearch = function () {
            $scope.$broadcast('doFeedSearch', $scope.searchString);
         };
      });

})();
