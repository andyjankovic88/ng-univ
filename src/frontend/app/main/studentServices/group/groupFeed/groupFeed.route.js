(function() {
   'use strict';

   angular
      .module('studentServicesView')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studentServicesFeed', {
            url: '/feed',
            templateUrl: '/app/main/studentServices/group/groupFeed/groupFeed.html',
            controller: 'studyGroupsFeedCtrl',
            parent: 'studentServicesView'

         });

   }

})();
