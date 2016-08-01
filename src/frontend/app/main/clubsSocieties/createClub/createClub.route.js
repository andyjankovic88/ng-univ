(function() {
   'use strict';

   angular
      .module('createClub')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('createClub', {
            cache: false,
            url: '/createClub',
            templateUrl: '/app/main/clubsSocieties/createClub/createClub.html',
            controller: 'CreateClubCtrl',
            controllerAs: 'ctrl',
            parent: 'main'

         });

   }

})();
