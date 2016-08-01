(function() {
   'use strict';

   angular
      .module('customgroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('customGroupsFeed', {
            url: '/feed',
            templateUrl: '/app/main/customGroups/group/groupFeed/groupFeed.html',
            controller: 'customGroupsFeedCtrl',
            parent: 'customgroup'

         });

   }

})();
