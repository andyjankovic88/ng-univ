(function() {
   'use strict';

   angular
      .module('firstSteps')
      .config(function($stateProvider) {
         $stateProvider
            .state('firstStepsStaffOne', {
               url: '/one',
               views: {                
                 'overlay' : {
                    templateUrl: '/app/main/firstSteps/staffOne/staffOne.html',
                    controller: 'firstStepsStaffOneCtrl'
                 },
               },
               parent: 'firstStepsStaff'
            });
      });

})();
