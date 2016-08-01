(function() {
   'use strict';

   angular
      .module('clubsSuggestions')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('clubsSuggestions', {
            url: '/suggestions',
            templateUrl: '/app/main/clubsSocieties/clubs/suggestions/suggestions.html',
            controller: 'clubsSuggestionsCtrl',
            parent: 'clubs'

         });

   }

})();
