(function() {
   "use strict";
   angular.module('firstSteps')
      .factory('firstStepsService', function($state, apiService) {
         var
            goCallback,
            states = [
               'firstStepsOne',
               'firstStepsTwo',
               'firstStepsThree',
               'firstStepsFour'
            ];

         function goNextStep(currentStateInd) {
            var completedStep = currentStateInd + 1;

            if( completedStep > 2 ) {               
               completedStep = 'All';
            }
            
            apiService.firstSteps.completeStep(completedStep);
            
            if (currentStateInd === states.length - 1) {
               $state.go('recentActivity');
            } else {
               $state.go(states[currentStateInd + 1]);
            }

         }

         return {
            goNext: function() {
               var
                  currentStateInd = states.indexOf($state.current.name);

               if (currentStateInd >= 0) {
                  if (angular.isFunction(goCallback)) {
                     goCallback().then(function() {
                     	goNextStep(currentStateInd);
                     });
                     goCallback = undefined;
                  } else {
               		goNextStep(currentStateInd);
                  }
               }
            },
            registerGoCallback: function(callback) {
               goCallback = callback;
            }

         };

      });



})();
