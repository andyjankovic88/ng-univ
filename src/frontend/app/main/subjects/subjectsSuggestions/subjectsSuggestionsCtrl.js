(function() {
   'use strict';

   angular
      .module('subjects')
      .controller('subjectsSuggestionsCtrl', function($scope, apiService) {
            $scope.suggestions = [];
            apiService.subjects.getSuggestions().then(function(response){
               $scope.suggestions = response.suggested;
            });
      });

})();
