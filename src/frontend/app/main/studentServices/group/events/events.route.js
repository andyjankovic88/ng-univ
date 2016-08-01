(function() {
   'use strict';

   angular
      .module('studentServicesView')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studentServicesEvents', {
            url: '/events',
            templateUrl: '/app/main/studentServices/group/events/events.html',
            controller: 'studentServicesEventsCtrl',
            parent: 'studentServicesView',

         });
   }

})();
