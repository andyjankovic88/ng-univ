(function () {
   "use strict";

   angular.module('postSummary')
      .directive('feedHeader', function (apiService, userService, alerts, userGroups) {
         return {
            restrict: 'E',
            scope: {
               feed: '=',
               feedType: '@',
               feedTypeId: '@',
               toggleEdit: '&',
               deletePost: '&'

            },
            templateUrl: '/app/components/postSummary/feedHeader/feedHeader.html',
            link: function ($scope) {

               $scope.hideDelete = function (feed) {
                  if ((userService.getInfo().group_id != userGroups.student) || (feed.user && userService.getInfo().id == feed.user.id)) {
                     return true;
                  } else {
                     return false;
                  }
               };

               $scope.like = function (feed) {
                  apiService.feeds.like($scope.feedType, $scope.feedTypeId, feed.id).then(
                     function (response) {
                        if (response.likes_count) {
                           feed.has_liked = true;
                           feed.likes_count++;
                        } else {
                           feed.has_liked = false;
                           feed.likes_count--;
                        }
                     }
                  );
               };

               $scope.canEdit = function() {
                  if ($scope.feed.user && $scope.feed.user.id == userService.getInfo().id) {
                     return true;
                  }

                  return false;
               };


               $scope.delete = function (post) {
                  alerts.confirm("Are you sure you want to delete this post?").then(function () {
                     apiService.feeds.delete('university', userService.getUnivInfo().id, post.id).then(function (response) {
                        $scope.deletePost();
                     });
                  })
               };

               $scope.report = function(post) {
                  apiService.feeds.report('university', userService.getUnivInfo().id, post.id)
                     .then(function () {
                        console.log('report success', arguments);
                     }, function (response) {
                        if (response && response.data && response.data.message) {
                           alerts.warning(response.data.message);
                        } else {
                           alerts.warning(JSON.stringify(response, null, 2));
                        }
                     });
               };
               $scope.edit = function(feed) {
                  $scope.toggleEdit();
               };
            }
         };
      });

})();
