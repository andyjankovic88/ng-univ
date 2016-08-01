(function() {
   'use strict';

   angular
      .module('studyTimer')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {

      $stateProvider
         .state('studyTimer', {
            abstract: true,
            views: {
              '' : {
                templateUrl: '/app/main/studyTimer/studyTimer.html',
                controller: 'studyTimerCtrl'
              },
              'right_side' : {
                 templateUrl: '/app/main/studyTimer/studyTimerRightSide/studyTimerRightSide.html',
                 controller:'studyTimerRightSideCtrl'
              },
            },
            parent: 'main'
         });

   }

})();
