(function() {
   'use strict';

   angular
      .module('connectionsSuggestions')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('connectionsSuggestions', {
            url: '/suggestions',
            templateUrl: '/app/main/connections/suggestions/suggestions.html',
            controller: 'connectionsSuggestionsCtrl',
            parent: 'connections'

         });

   }

})();
