(function () {
   'use strict';

   angular
      .module('subjects')
      .controller('addSubjectCtrl', function ($scope, $q, $state, apiService, userService) {
         $scope.selectedSubject = [];

         $scope.cancel = function () {
            $scope.selectedSubject = [];
         };
         $scope.enroll = function () {
            var subjects = $scope.selectedSubject.map(function (subject) {
               subject.title = subject.code;
               userService.getMenu().unit.push(subject);
               return subject.id;
            });
            apiService.subjects.enrollSubjects(subjects, userService.getInfo().id).then(
               function () {
                  $state.go('subjectsList');
               },
               function () {

               }
            );
         };

      });
})();
