(function() {
   'use strict';

   angular
      .module('customgroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('customGroupsList', {
            url: '/customGroupsList',
            templateUrl: '/app/main/customGroups/groups/groupsList/groupsList.html',
            controller: 'customGroupsListCtrl',
            parent: 'customgroups'

         });

   }

})();
