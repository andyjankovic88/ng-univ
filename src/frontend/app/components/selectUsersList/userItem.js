( function() {

'use strict';

angular.module('selectUserList')
.directive('userItem', function($state) {
	return {
		restrict: 'E',
		scope: {
            data: '=',
            linkToProfile: '@'
        },
		templateUrl: '/app/components/selectUsersList/userItem.html',
		link: function() {
			
		}
	};
});

}) ();