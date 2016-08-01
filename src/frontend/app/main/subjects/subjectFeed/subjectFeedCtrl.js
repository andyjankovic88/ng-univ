(function() {
   'use strict';

   angular
      .module('subjects')
      .controller('subjectsFeedCtrl', function($scope, $stateParams) {
         $scope.id = $stateParams.id;
//         $scope.name = $scope.subjects.filter(function (subject) { return subject.id === $scope.id})[0].name;
      });

})();