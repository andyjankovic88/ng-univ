(function() {
   'use strict';

   angular
      .module('studentServicesView')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studentServicesInfo', {
            url: '/info',
            templateUrl: '/app/main/studentServices/group/groupInfo/groupInfo.html',
            controller: 'studentServicesInfoCtrl',
            parent: 'studentServicesView'

         });

   }

})();
