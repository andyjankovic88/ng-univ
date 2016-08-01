(function() {
   'use strict';

   angular
      .module('club')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('committeeFeed', {
            url: '/committeeFeed',
            templateUrl: '/app/main/clubsSocieties/club/committeeFeed/committeeFeed.html',
            controller: 'committeeFeedCtrl',
            parent: 'club'

         });

   }

})();
