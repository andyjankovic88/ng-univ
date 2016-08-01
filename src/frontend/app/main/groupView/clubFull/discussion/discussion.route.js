(function() {
   'use strict';

   angular
      .module('discussion')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('discussion', {
            url: '/discussion',
            templateUrl: '/app/main/groupView/clubFull/discussion/discussion.html',
            controller: 'discussionCtrl',
            parent: 'clubFull'

         });

   }

})();
