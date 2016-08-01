(function() {
   'use strict';

   angular
      .module('universityFeeds')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('universityGroupsFeed', {
            url: '/feed',
            templateUrl: '/app/main/universityFeeds/groupFeed/groupFeed.html',
            controller: 'universityGroupsFeedsCtrl',
            parent: 'universityFeeds'

         });

   }

})();
