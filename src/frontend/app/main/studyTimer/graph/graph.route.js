(function() {
   'use strict';

   angular
      .module('studyTimer')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {

      $stateProvider
         .state('studyTimerGraph', {
            url: '/studyTimer/graph',
            templateUrl: '/app/main/studyTimer/graph/graph.html',
            controller: 'graphCtrl',
            parent: 'studyTimer'
         });

   }

})();
