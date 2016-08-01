(function() {
   'use strict';

   angular
      .module('clubsList')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('clubsList', {
            url: '/clubsList',
            templateUrl: '/app/main/clubsSocieties/clubs/clubsList/clubsList.html',
            controller: 'clubsListCtrl',
            parent: 'clubs'

         });

   }

})();
