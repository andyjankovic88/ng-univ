(function() {

   'use strict';

   angular
      .module('firstSteps')
      .controller('firstStepsTwoCtrl', function($scope, apiService, userService, firstStepsService, $q) {
         $scope.selectedSubject = [];

         function enroll() {
            var subjects = $scope.selectedSubject.map(function(subject) {
               subject.title = subject.code;
               userService.getMenu().unit.push(subject);
               return subject.id;
            });
            return $q(function(resolve, reject) {
                  if(!subjects.length) {
                     resolve();
                     return;
                  }
                  apiService.subjects.enrollSubjects(subjects, userService.getInfo().id).then(
                     function() {                     
                        resolve();
                     },
                     function() {
                        reject();
                     }
                  );

               });
         }

         firstStepsService.registerGoCallback(enroll);


      });


})();
