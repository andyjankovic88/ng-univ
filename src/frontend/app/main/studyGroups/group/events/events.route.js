(function() {
   'use strict';

   angular
      .module('studyGroupsView')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studyGroupEvents', {
            url: '/events',
            templateUrl: '/app/main/studyGroups/group/events/events.html',
            controller: 'studyGroupEventsCtrl',
            parent: 'studygroupview'
         });
   }

})();
