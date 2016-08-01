(function() {
   'use strict';

   angular
      .module('subjects')
      .controller('subjectsListCtrl', function($scope, apiService) {
         $scope.leaveSubject = function (id, $index) {
            $scope.subjects[$index].disabled = true;
            apiService.subjects.leave(id).then(
               function () {
                  $scope.subjects.splice($index, 1);
               }
            );
         }
      });

})();
