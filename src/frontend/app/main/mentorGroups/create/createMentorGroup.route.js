(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('creteMentorGroup', {
            url: '/creteMentorGroup',
            templateUrl: '/app/main/mentorGroups/create/createMentorGroup.html',
            controller: 'createMentorGroupCtrl',
            parent: 'mentorGroups',
            params: {
               id: ''
            }

         });

   }

})();
