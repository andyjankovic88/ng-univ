(function() {
   'use strict';

   angular
      .module('customgroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('customGroupSuggestions', {
            url: '/customGroupSuggestions',
            templateUrl: '/app/main/customGroups/groups/suggestions/suggestions.html',
            controller: 'customGroupsSuggestionsCtrl',
            parent: 'customgroups'

         });

   }

})();
