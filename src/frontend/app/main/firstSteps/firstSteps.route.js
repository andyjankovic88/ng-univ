(function() {
   'use strict';

   angular
      .module('firstSteps')
      .config(function($stateProvider) {
         $stateProvider
            .state('firstSteps', {
               url: 'firstSteps',
               abstract: true,
               views: {
                 'overlay' : {
                    templateUrl: '/app/main/firstSteps/firstSteps.html',
                    controller: 'firstStepsCtrl'
                 },
               },
               parent: 'recentActivity'

            });
      });

})();
