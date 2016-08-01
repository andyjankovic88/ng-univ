(function() {
   'use strict';

   angular
      .module('universityFeeds')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('universityEvents', {
            url: '/events',
            templateUrl: '/app/main/universityFeeds/events/events.html',
            controller: 'universityFeedsEventsCtrl',
            parent: 'universityFeeds'
         });
   }

})();
