(function() {

    'use strict';

    angular.module('rightSidebar')
        .directive('rhsUsersListDirective', function(apiService, userService, alerts) {
            return {
                restrict: 'E',
                scope: {
                    list: '=',
                    title: '@',
                    isExpandable: '@'
                },
                templateUrl: '/app/components/sidebarRight/usersList/usersList.html',
                link: function(scope) {
                    var
                        collapsedLimit = 5;


                    scope.isCollapsed = true;
                    scope.limit = collapsedLimit;
                    scope.collapsedLimit = collapsedLimit;

                    scope.switchState = function() {
                        scope.isCollapsed = !scope.isCollapsed;
                        scope.limit = scope.isCollapsed ? collapsedLimit : 999;
                    };
                    scope.sendConnectRequest = function ($index, following) {
                       apiService.connections.connect(userService.getInfo().id, following).then(function (response) {
                          alerts.info("Connection request was sent");
                          scope.list.splice($index, 1);
                       }, function (err) {

                       });
                    };

                },

            };
        });


})();
