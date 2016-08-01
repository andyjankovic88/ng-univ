(function() {
   'use strict';

   angular
      .module('events')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('events', {
            url: '/events',
            templateUrl: '/app/main/clubsSocieties/club/events/events.html',
            controller: 'EventsCtrl',
            parent: 'club'

         });

   }

})();
