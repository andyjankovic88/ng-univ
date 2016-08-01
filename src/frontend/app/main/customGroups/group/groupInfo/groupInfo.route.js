(function() {
   'use strict';

   angular
      .module('customgroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('customGroupsInfo', {
            url: '/info',
            templateUrl: '/app/main/customGroups/group/groupInfo/groupInfo.html',
            controller: 'customGroupsInfofoCtrl',
            parent: 'customgroup'

         });

   }

})();
