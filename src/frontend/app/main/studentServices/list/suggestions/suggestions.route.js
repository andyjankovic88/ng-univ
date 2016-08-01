(function() {
   'use strict';

   angular
      .module('studentServicesSuggestions')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studentServicesSuggestions', {
            url: '/suggestions',
            templateUrl: '/app/main/studentServices/list/suggestions/suggestions.html',
            controller: 'studentServicesSuggestionsCtrl',
            parent: 'studentServicesList'

         });

   }

})();
