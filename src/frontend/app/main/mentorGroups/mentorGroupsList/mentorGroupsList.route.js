(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('mentorGroupsList', {
            url: '/list',
            templateUrl: '/app/main/mentorGroups/mentorGroupsList/mentorGroupsList.html',
            controller: 'mentorGroupsListCtrl',
            parent: 'mentorGroups'

         });

   }

})();
