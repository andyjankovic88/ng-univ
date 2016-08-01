(function() {
	"use strict";

	angular.module('marketplace')
	.directive('itemBriefInfo', function() {
		return {
			restrict: 'E',
			scope: {
				item: '='
			},
			templateUrl: '/app/main/marketplace/directives/itemBriefInfo/itemBriefInfo.html'

		};
	});


})();