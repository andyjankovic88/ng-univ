(function() {
   'use strict';

   angular
      .module('customgroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('createCustomGroup', {
            url: '/createCustomGroup/:edit_id',
            templateUrl: '/app/main/customGroups/createCustomGroup/createCustomGroup.html',
            controller: 'createCustomGroupCtrl',
            parent: 'main',
            params: {
               edit_id: ''
            }

         });

   }

})();
