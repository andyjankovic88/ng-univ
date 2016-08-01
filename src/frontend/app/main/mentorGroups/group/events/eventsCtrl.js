(function () {
   'use strict';

   angular
      .module('mentorGroups')
      .controller('mentorGroupEventsCtrl', function ($scope, $stateParams) {
      	$scope.id = $stateParams.id;
      });

})();
