(function() {
   'use strict';

   angular
      .module('customgroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('customgroups', {
            url: '/customGroups',
            templateUrl: '/app/main/customGroups/groups/groups.html',
            controller: 'customGroupsCtrl',
            parent: 'main'

         });

   }

})();
