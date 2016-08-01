	(function() {
	   'use strict';

	   angular
	      .module('main')
	      .controller('defaultRightSideCtrl', function($scope, apiService, $timeout) {

	         $scope.connections = [];
	         apiService.getRHS().then(function(response) {

	            $timeout(function() { // fix bug with animation if responsed from cache
	               $scope.connections = response.suggested_connections;
	            }, 50);

	         });

	      });
	})();
