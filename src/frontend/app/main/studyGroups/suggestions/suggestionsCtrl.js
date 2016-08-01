(function() {
   'use strict';

   angular
      .module('studyGroupsSuggestions', [])
      .controller('studyGroupsSuggestionsCtrl', function($scope, apiService, userService) {
         var page = 0;

         $scope.scrollContainer = $('.middle-section').eq(0);

         $scope.listRequestInProgress = false;
         $scope.noMoreData = false;

         $scope.groupSuggestions = [];

         $scope.loadNextPage = function(reset) {
            $scope.listRequestInProgress = true;

            if(reset) {
               page = 0;
            }
            apiService.studyGroups.suggestions(userService.getInfo().id, page).then(
               function(response) {
                  if(angular.isArray(response.suggested_studygroups) && response.suggested_studygroups.length > 0) {
                        $scope.groupSuggestions = reset ? response : $scope.groupSuggestions.concat(response.suggested_studygroups);
                        page++;
                  } else {
                     $scope.noMoreData = true;
                  }
                  $scope.listRequestInProgress = false;
               }, function (err) {
                  $scope.noMoreData = true;
                  $scope.listRequestInProgress = false;
               }
            );
         };
      });

})();
