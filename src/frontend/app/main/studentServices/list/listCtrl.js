(function () {
   'use strict';

   angular
      .module('studentServicesList', [])
      .controller('studentServicesListCtrl', function ($scope, userGroups, userService) {

         $scope.isCreateable = userService.getInfo().group_id != userGroups.student;

      });

})();
