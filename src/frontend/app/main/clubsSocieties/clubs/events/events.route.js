(function() {
   'use strict';

   angular
      .module('clubsEvents')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('clubsEvents', {
            url: '/events',
            templateUrl: '/app/main/clubsSocieties/clubs/events/events.html',
            controller: 'clubsEventsCtrl',
            parent: 'clubs'

         });

   }

})();
