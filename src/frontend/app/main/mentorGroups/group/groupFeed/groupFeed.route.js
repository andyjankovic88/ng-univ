(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('mentorGroupsFeed', {
            url: '/feed',
            templateUrl: '/app/main/mentorGroups/group/groupFeed/groupFeed.html',
            controller: 'mentorGroupsFeedCtrl',
            parent: 'mentorgroup'

         });

   }

})();
