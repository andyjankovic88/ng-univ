(function() {
   "use strict";

   angular.module('postSummary')
      .directive('likesComments', function(apiService, userService) {
         return {
            restrict: 'E',
            scope: {
               isLiked: '=',
               likes: '@',
               comments: '@',
               like: '&'
            },
            templateUrl: '/app/components/postSummary/likesComments/likesComments.html',
            link: function($scope) {




            }
         };
      });

})();
