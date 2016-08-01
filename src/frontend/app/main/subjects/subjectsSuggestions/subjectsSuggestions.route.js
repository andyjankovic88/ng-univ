(function() {
   'use strict';

   angular
      .module('subjects')
      .config(function($stateProvider) {
         $stateProvider
            .state('subjectsSuggestions', {
               url: '/subjects-suggestions',
               templateUrl: '/app/main/subjects/subjectsSuggestions/subjectsSuggestions.html',
               controller: 'subjectsSuggestionsCtrl',
               parent: 'subjects'
            });
      });

})();
