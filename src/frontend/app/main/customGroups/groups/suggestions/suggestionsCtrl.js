(function() {
   'use strict';

   angular
      .module('customgroups')
      .controller('customGroupsSuggestionsCtrl', function($scope, apiService) {
         var page = 0;

         $scope.listRequestInProgress = false;

         $scope.group_suggestions = [];

         $scope.loadNextPage = function(reset) {
            $scope.listRequestInProgress = true;

            if(reset) {
               page = 0;
            }

            apiService.customGroups.getSuggestions(page).then(
               function(response) {
                 if(angular.isArray(response)) {
                    if (response.length > 0) {
                       $scope.group_suggestions = reset ? response : $scope.group_suggestions.concat(response);
                       page++;
                       $scope.listRequestInProgress = false;
                    }
                 } 
               }
            );
         };
      });

})();
