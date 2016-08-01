(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .controller('mentorGroupsFeedCtrl', function($scope, $stateParams) {
      	$scope.id = $stateParams.id;
      });

})();
