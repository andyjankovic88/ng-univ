(function() {
   'use strict';

   angular
      .module('groups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('profile.groups', {
            url: '/groups',
            templateUrl: '/app/main/profile/groups/groups.html',
            controller: 'groupsCtrl',
            parent: 'profile'

         });

   }

})();
