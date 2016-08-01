(function() {
   "use strict";

   angular.module('firstSteps', [])
   .controller('firstStepsCtrl', function($scope, firstStepsService) {      
      $scope.done = function() {
      	firstStepsService.goNext();
      };
   });

})();
