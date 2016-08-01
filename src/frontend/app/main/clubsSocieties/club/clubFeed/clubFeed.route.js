(function() {
   'use strict';

   angular
      .module('clubFeed')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('clubFeed', {
            url: '/feed',
            templateUrl: '/app/main/clubsSocieties/club/clubFeed/clubFeed.html',
            controller: 'clubFeedCtrl',
            parent: 'club'

         });

   }

})();
