(function() {
   'use strict';

   angular
      .module('studentServicesListGeneral')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studentServicesListGeneral', {
            url: '/list',
            templateUrl: '/app/main/studentServices/list/general/general.html',
            controller: 'studentServicesListGeneralCtrl',
            parent: 'studentServicesList'

         });

   }

})();
