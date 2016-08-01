(function () {
   'use strict';

   angular
      .module('newsDetails', [])
      .controller('newsDetailsCtrl', function ($scope, apiService, $stateParams, userService, $sce, helper, $window, $state) {
         var newsListInd = helper.findById($scope.posts, 'id', parseInt($stateParams.id));
         $scope.id = $stateParams.id;

         if(newsListInd < 0) {
            apiService.ucrooNews.get(userService.getMenu().student_news.id, $stateParams.id).then(
               function (response) {
                  if(response.posts && response.posts.length) {
                     $scope.post = response.posts[0];
                     if ($scope.post.link_details) {
                        $scope.post.trustedHTML = $sce.trustAsHtml($scope.post.link_details.description);
                     } else {
                        $scope.post.trustedHTML = '';
                     }
                  }


               }
            );
         } else {
            $scope.post = $scope.posts[newsListInd];
            if(!$scope.post.trustedHTML) {
               if ($scope.post.link_details) {
                  $scope.post.trustedHTML = $sce.trustAsHtml($scope.post.link_details.description);
               } else {
                  $scope.post.trustedHTML = '';
               }
            }
         };

         $scope.goBack = function () {
            $window.history.back();
         }


      });

})();
