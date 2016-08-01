(function() {
   'use strict';

   angular
      .module('firstSteps')
      .config(function($stateProvider) {
         $stateProvider
            .state('firstStepsThree', {
               url: '/three',
                    templateUrl: '/app/main/firstSteps/three/three.html',
                    controller:'firstStepsThreeCtrl',
               parent: 'firstSteps'
            });
      });

})();
