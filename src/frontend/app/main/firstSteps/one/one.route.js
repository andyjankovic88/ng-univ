(function() {
   'use strict';

   angular
      .module('firstSteps')
      .config(function($stateProvider) {
         $stateProvider
            .state('firstStepsOne', {
               url: '/one',
                    templateUrl: '/app/main/firstSteps/one/one.html',
                    controller:'firstStepsOneCtrl',
               parent: 'firstSteps'
            });
      });

})();
