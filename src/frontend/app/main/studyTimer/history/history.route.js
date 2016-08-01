(function() {
   'use strict';

   angular
      .module('studyTimer')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {

      $stateProvider
         .state('studyTimerHistory', {
            url: '/studyTimer/history',
            templateUrl: '/app/main/studyTimer/history/history.html',
            controller: 'historyCtrl',
            parent: 'studyTimer'
         });

   }

})();
