(function() {
   'use strict';

   angular
      .module('studentServicesCreate')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studentServicesCreate', {
            url: '/create',
            templateUrl: '/app/main/studentServices/create/create.html',
            controller: 'studentServicesCreateCtrl',
            parent: 'studentServices'
         }).state('studentServicesEdit', {
            url: '/edit/:service_id',
            templateUrl: '/app/main/studentServices/create/create.html',
            controller: 'studentServicesCreateCtrl',
            parent: 'studentServices'
         });
   }

})();
