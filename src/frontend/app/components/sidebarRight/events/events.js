(function() {

    'use strict';

    angular.module('rightSidebar')
        .directive('rhsEvents', function($state) {
            return {
                restrict: 'E',
                scope: {
                    list: '=',
                    stateName: '@'
                },
                templateUrl: '/app/components/sidebarRight/events/events.html',
                link: function($scope) {
                    var
                        collapsedLimit = 5;

                    
                    $scope.limit = collapsedLimit;

                    $scope.seeAll = function() {
                        $state.go($scope.stateName);
                    };               

                },

            };
        });


})();
