(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .controller('mentorGroupsInfoCtrl', function($scope) {
         $scope.$watch('group', function(val) {
         	console.log(val);
         });
      });

})();
