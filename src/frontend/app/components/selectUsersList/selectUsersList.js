( function() {

'use strict';

angular.module('selectUserList', [])
.directive('usersList', function(apiService, userService, alerts) {
	return {
		restrict: 'E',
		scope: {
            users: '='
        },
		templateUrl: '/app/components/selectUsersList/selectUsersList.html',
		link: function(scope, element, attrs) {
//            var pagesShown = 1;
//            var pageSize = 12;
//
//            scope.paginationLimit = function (data) {
//               return pageSize * pagesShown;
//            };
//
//            scope.hasMoreItemsToShow = function () {
//               return pagesShown < (scope.users.length / pageSize);
//            };
//
//            scope.showMoreItems = function () {
//               pagesShown = pagesShown + 1;
//            };
		}
	};
});

}) ();