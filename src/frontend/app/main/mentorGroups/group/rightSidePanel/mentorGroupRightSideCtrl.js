(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .controller('mentorGroupRightSideCtrl', function($scope, apiService, $stateParams, alerts) {
         var id = $stateParams.id;

         $scope.data = {};

         apiService.mentorGroups.sidebar(id).then(
         	function(response) {
					$scope.data = response;         		

         	},	
         	function(response) {
         		alerts.warning(response.data.message);
         	}
      	);



      });
})();
