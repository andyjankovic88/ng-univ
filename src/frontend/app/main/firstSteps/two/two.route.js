(function() {
   'use strict';

   angular
      .module('firstSteps')
      .config(function($stateProvider) {
         $stateProvider
            .state('firstStepsTwo', {
               url: '/two',
                    templateUrl: '/app/main/firstSteps/two/two.html',
                    controller:'firstStepsTwoCtrl',
               parent: 'firstSteps'
            });
      });

})();
