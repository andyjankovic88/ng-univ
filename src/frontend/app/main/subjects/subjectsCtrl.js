(function() {
   'use strict';

   angular
      .module('subjects', [])
      .controller('subjectsCtrl', function($scope, $state, userService, userGroups, apiService) {
         $scope.uiRouterState = $state;
         $scope.adminAccess = false;
         if (userService.getInfo().group_id == userGroups.admin || userService.getInfo().group_id == userGroups.academic) $scope.adminAccess = true;
         $scope.addSubject = function() {
            if ($scope.adminAccess) {
               return 'addSubjectAdmin'
            }
            return 'addSubject';
         };
         $scope.subjects = [];
         apiService.subjects.getList().then(function(response){
            $scope.subjects = response;
         });
      });

})();
