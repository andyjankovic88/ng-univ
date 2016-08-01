(function() {
   'use strict';

   angular
      .module('studyGroupsSuggestions')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studyGroupsSuggestions', {
            url: '/suggestions',
            templateUrl: '/app/main/studyGroups/suggestions/suggestions.html',
            controller: 'studyGroupsSuggestionsCtrl',
            parent: 'studyGroups'

         });

   }

})();
