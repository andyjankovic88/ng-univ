(function() {
   'use strict';

   angular
      .module('connectionsRequests')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('connectionsRequests', {
            url: '/requests',
            templateUrl: '/app/main/connections/requests/requests.html',
            controller: 'requestsCtrl',
            parent: 'connections'

         });

   }

})();
