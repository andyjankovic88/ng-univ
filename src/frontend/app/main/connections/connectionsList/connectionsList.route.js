(function() {
   'use strict';

   angular
      .module('connectionsList')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('connectionsList', {
            url: '/list',
            templateUrl: '/app/main/connections/connectionsList/connectionsList.html',
            controller: 'connectionsListCtrl',
            parent: 'connections'

         });

   }

})();
