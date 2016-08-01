(function() {
   'use strict';

   angular
      .module('firstSteps')
      .config(function($stateProvider) {
         $stateProvider
            .state('firstStepsFour', {
               url: '/firstSteps/four',
               views: {                
                 'overlay' : {
                    templateUrl: '/app/main/firstSteps/four/four.html',
                    controller: 'firstStepsFourCtrl'
                 },
               },
               parent: 'recentActivity'
            });
      });

})();
