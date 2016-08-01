(function() {
   'use strict';

   angular
      .module('suggestions')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('suggestions', {
            url: '/suggestions',
            templateUrl: '/app/main/groupView/customGroup/suggestions/suggestions.html',
            controller: 'suggestionsCtrl',
            parent: 'customGroup'

         });

   }

})();
