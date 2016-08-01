(function() {
   'use strict';

   angular
      .module('studyGroupsView')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studyGroupsFeed', {
            url: '/feed',
            templateUrl: '/app/main/studyGroups/group/groupFeed/groupFeed.html',
            controller: 'studyGroupsFeedCtrl',
            parent: 'studygroupview'

         });

   }

})();
