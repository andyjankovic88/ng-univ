(function () {
   'use strict';

   angular
      .module('universityFeeds', [])
      .controller('feedsCtrl', function ($scope, apiService, userService, $state) {
         $scope.group_type = 'university';
         $scope.feedId = userService.getUnivInfo().id;
         $scope.university_title = userService.getUnivInfo().name;
         $scope.doFeedSearch = function () {
            $scope.$broadcast('doFeedSearch', $scope.searchString);
         };
      });

})();
