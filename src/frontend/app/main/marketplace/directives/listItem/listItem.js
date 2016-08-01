(function() {
    "use strict";

    angular.module('marketplace')
        .directive('marketplaceListItem', function(userService) {
            return {
                restrict: 'E',
                scope: {
                    item: '=',
                    deleteItem: '&',
                    soldItem: '&'
                },
                templateUrl: '/app/main/marketplace/directives/listItem/listItem.html',
                link: function($scope) {

                    $scope.userId = userService.getInfo().id;

                    $scope.getType = function() {
                        if($scope.item.item_type === 'want') {
                            return "WANTED";
                        } else {
                            return "FOR SALE";
                        }
                    };

                }


            };
        });

})();
