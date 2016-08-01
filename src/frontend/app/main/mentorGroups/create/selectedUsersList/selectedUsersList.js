(function() {
    'use strict';

    angular
        .module('mentorGroups')
        .directive('selectedUsersList', function(helper) {
            return {
                restrict: 'E',
                scope: {
                    list: '='
                },
                templateUrl: '/app/main/mentorGroups/create/selectedUsersList/selectedUsersList.html',
                link: function($scope) {
                    $scope.remove = function(item) {
                        helper.removeElement($scope.list, $scope.list.indexOf(item));
                    };


                }
            };
        });
})();
