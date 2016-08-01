(function() {
   'use strict';

   angular
      .module('customGroup')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('customGroup', {
            url: '/customGroup',
            templateUrl: '/app/main/groupView/customGroup/customGroup.html',
            controller: 'customGroupCtrl',
            parent: 'groupView'

         });

   }

})();
