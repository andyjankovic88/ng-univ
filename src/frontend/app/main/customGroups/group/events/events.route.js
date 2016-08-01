(function() {
   'use strict';

   angular
      .module('customgroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('customGroupEvents', {
            url: '/events',
            templateUrl: '/app/main/customGroups/group/events/events.html',
            controller: 'customGroupEventsCtrl',
            parent: 'customgroup'
         });
   }

})();
