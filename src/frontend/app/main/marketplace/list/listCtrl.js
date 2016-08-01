(function() {
    'use strict';

    angular
        .module('marketplace')
        .controller('marketplaceListCtrl', function($scope, apiService, $stateParams, helper, userService) {            
            $scope.userId = userService.getInfo().id;
            $scope.userParam = $stateParams.userId;
            $scope.goods = [];
            $scope.isLoading = true;
            $scope.categories = [];
            $scope.selectedCategories = [];
            $scope.selectedCampuses = [];
            $scope.searchTerm = '';
            $scope.sortOptions = [{
                text: "High to Low",
                value: 'asc'
            }, {
                text: "Low to High",
                value: 'desc'
            }];
            $scope.selectedSort = {
                text: "High to Low"
            };

            getGoods();
            apiService.marketplace.initialInfo().then(
                function(response) {
                    $scope.categories = response.categories;
                    $scope.campuses = response.campus;
                },
                function() {

                }
            );            

            $scope.$watch('selectedCategories', function(val, old) {
                if (val !== old) {
                    getGoods();
                }
            });
            $scope.$watch('selectedCampuses', function(val, old) {
                if (val !== old) {
                    getGoods();
                }
            });
            $scope.onSortChanged = function(selected) {
                if (selected && selected.value) {
                    getGoods();
                }
            };

            $scope.deleteItem = function(item) {
                apiService.marketplace.remove(item.user.id, item.item_id).then(
                    function() {
                        helper.removeElement($scope.goods, $scope.goods.indexOf(item));
                    }

                );
            };

            $scope.soldItem = function(item) {
                apiService.marketplace.sold(item.user.id, item.item_id).then(
                    function() {
                        helper.removeElement($scope.goods, $scope.goods.indexOf(item));
                    }
                    
                );
            };

            function getGoods() {
                apiService.marketplace.list($scope.searchTerm, $scope.selectedCategories, $scope.selectedCampuses, $scope.selectedSort.value, $scope.userParam).then(
                    function(response) {
                        $scope.isLoading = false;
                        $scope.goods = response.items;                        
                    },
                    function() {

                    }
                );
            }


           
        });

})();
