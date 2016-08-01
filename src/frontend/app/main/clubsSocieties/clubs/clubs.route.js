(function() {
   'use strict';

   angular
      .module('clubs')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('clubs', {
            url: '/clubs',
            templateUrl: '/app/main/clubsSocieties/clubs/clubs.html',
            controller: 'clubsCtrl',
            parent: 'main'

         });

   }

})();
