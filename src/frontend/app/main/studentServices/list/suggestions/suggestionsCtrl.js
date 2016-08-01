(function() {
   'use strict';

   angular
      .module('studentServicesSuggestions', [])
      .controller('studentServicesSuggestionsCtrl', function($scope, apiService, userService) {
         var page = 0;

         $scope.scrollContainer = $('.middle-section').eq(0);

         $scope.listRequestInProgress = false;
         $scope.noMoreData = false;

         $scope.suggestions = [];

         function init () {
            $scope.listRequestInProgress = true;
            apiService.studentServices.suggestions().then(
               function (response) {
                  $scope.listRequestInProgress = false;
                  $scope.suggestions = response.suggested_services;
               }, function (err) {
                  $scope.listRequestInProgress = false;
               }
            );
         }
         init();
      });

})();
