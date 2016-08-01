(function () {
   'use strict';

   angular
      .module('conversationList', [])
      .controller('conversationListCtrl', function ($scope, apiService, $sce) {
         var page = 0;

         $scope.listRequestInProgress = false;
         $scope.conversations = [];


         $scope.loadNextPage = function (reset) {
            $scope.listRequestInProgress = true;

            if (reset) {
               page = 0;
            }
            $scope.loaderActive = true;
            apiService.messages.conversations(page).then(
               function (response) {
                  $scope.loaderActive = false;
                  if (angular.isArray(response)) {
                     if (response.length > 0) {
                        angular.forEach(response, function (val) {
                           val.message_text = $sce.trustAsHtml(val.message_text);
                        });
                        $scope.conversations = reset ? response : $scope.conversations.concat(response);
                        page++;
                        $scope.listRequestInProgress = false;
                     }
                  }  // if posts.length < 1 - we reach end of list so we leave listRequestInProgress = false to prevent nextPage requests
               }
            );
         };

         $scope.loadNextPage();

      });

})();
