(function() {

    'use strict';

    angular.module('rightSidebar', [])
        .directive('atUniversityDirective', function(apiService, $timeout) {
            return {
                restrict: 'E',
                scope: {

                },
                templateUrl: '/app/components/sidebarRight/atUniversity/atUniversity.html',
                link: function(scope) {
                    var
                        collapsedLimit = 2;

                    scope.isCollapsed = true;
                    scope.limit = collapsedLimit;

                    scope.switchState = function() {
                        scope.isCollapsed = !scope.isCollapsed;
                        scope.limit = scope.isCollapsed ? collapsedLimit : 999;
                    };

                    scope.atUniversity = {};
                    apiService.getRHS().then(function(response) {
                        $timeout(function() {  // fix bug with animation if responsed from cache
                            scope.atUniversity = response.at_university;
                        }, 50);
                    });
                },

            };
        });


})();
