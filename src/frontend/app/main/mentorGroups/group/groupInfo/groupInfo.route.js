(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('mentorGroupsInfo', {
            url: '/info',
            templateUrl: '/app/main/mentorGroups/group/groupInfo/groupInfo.html',
            controller: 'mentorGroupsInfoCtrl',
            parent: 'mentorgroup'

         });

   }

})();
