(function() {
   'use strict';

   angular
      .module('globalSearch')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('globalSearch', {
            url: '/globalSearch/:terms',
            templateUrl: '/app/main/globalSearch/globalSearch.html',
            controller: 'globalSearchCtrl',
            parent: 'main',
            params: {
               terms: ''
            }

         });

   }

})();
