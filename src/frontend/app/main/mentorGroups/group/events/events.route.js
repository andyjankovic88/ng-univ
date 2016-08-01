(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('mentorGroupEvents', {
            url: '/events',
            templateUrl: '/app/main/mentorGroups/group/events/events.html',
            controller: 'mentorGroupEventsCtrl',
            parent: 'mentorgroup'
         });
   }

})();
