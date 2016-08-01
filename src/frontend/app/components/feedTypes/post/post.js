(function () {
   "use strict";

   angular.module('feedTypes')
      .directive('feedsPost', function($sce){
         return {
            restrict: 'E',
            scope: {
               feed: '='
            },
            templateUrl: '/app/components/feedTypes/post/post.html',
            link: function($scope) {
               $scope.text = $sce.trustAsHtml($scope.feed.text);
            }
         }
      });
})();
