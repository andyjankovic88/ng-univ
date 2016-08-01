(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {     

      $stateProvider
         .state('mentorGroups', {            
            url: '/mentors',
            templateUrl: '/app/main/mentorGroups/mentorGroups.html',
            controller: 'mentorGroupsCtrl',
            parent: 'main'
         });

   }

})();
