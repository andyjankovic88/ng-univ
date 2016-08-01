(function() {

	'use strict';

	angular.module('rightSidebar')
		.directive('inviteDirective', function() {
			return {
				restrict: 'E',
				scope: {

				},
				templateUrl: '/app/components/sidebarRight/invite/invite.html',
				link: function() {

				},

			};
		});

})();
