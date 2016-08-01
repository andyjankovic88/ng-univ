( function() {

'use strict';

angular.module('header', [])
.directive('headerDirective', function(userService, userGroups, $state, header) {
	return {
		restrict: 'E',
		scope: {},
		templateUrl: '/app/components/header/header.html',
		link: function(scope) {

			scope.activeWidget = '';
			scope.isHideContent = false;
			scope.userId = userService.getInfo().id;

         scope.isStudent = userService.getInfo().group_id == userGroups.student;

         scope.activate = function(name, hideContent, data) {
				scope.isHideContent = !!hideContent;

				if(scope.activeWidget === name) {
					scope.activeWidget = '';
				} else {
               scope.$broadcast('headerWidgetActivated', {name: name, data: data});
					scope.activeWidget = name;
				}
			};
			scope.onClickOutside = function() {
				if(!scope.isHideContent) {
					scope.activeWidget = '';
               scope.$digest();
					return;
				}
			};
			scope.$on('closeHeaderWidget', function() {
				scope.isHideContent = false;
				scope.activeWidget = '';

			});

			scope.userInfo = userService.getInfo();

         scope.logout = function() {
            userService.logout();
            $state.go('login');
         };



         header.register({
      		activateWidget: function(name, hideContent, data) {
               scope.$broadcast('headerWidgetActivated', {name: name, data: data});
					scope.activeWidget = name;
					scope.isHideContent = !!hideContent;
      		},
      		deactivateWidget: scope.onClickOutside
         });

		}
	};
});

}) ();
