(function() {
    'use strict';

    var LIST_LIMIT = 10;

    angular
        .module('mentorGroups')
        .directive('searchByName', function(apiService) {
            return {
                restrict: 'E',
                scope: {
                    onSelect: '&'
                },
                templateUrl: '/app/main/mentorGroups/create/searchByName/searchByName.html',
                link: function($scope) {
                	var
                		hasDeferredSearch = false;
                	
                	$scope.loading = false;
                	$scope.listLimit = LIST_LIMIT;
                	$scope.select = select;


                	reset();

                	$scope.search = function() {
                        if ($scope.loading) {
                            hasDeferredSearch = true;
                            return;
                        }                                                

                        hasDeferredSearch = false;
                        if ($scope.searchTerm.length > 3) {
                            $scope.loading = true;
                            apiService.mentorGroups.searchMentors($scope.searchTerm).then(
                                function(response) {
                                    $scope.loading = false;
                                    $scope.results = response;
                                    if (hasDeferredSearch) {
                                        $scope.search();
                                    }

                                }
                            );
                        }
                    };

                    $scope.onKeydown = function($event) {
                        switch ($event.which) {
                            case 38: // key up
                                moveSelection(-1);
                                break;
                            case 40: // key down
                                moveSelection(1);
                                break;
                            case 13: // enter    
                                 if(($scope.activeItem < $scope.results.length) && ($scope.activeItem >= 0)) {
                                    select($scope.activeItem, $scope.results[$scope.activeItem]);
                                 }                                
                                break;
                        }
                    };

                    function reset() {
                        $scope.searchTerm = "";
                        $scope.results = [];
                        $scope.activeItem = -1;
                    }
                    
                    function select($index, item) {                        
                        $scope.onSelect({$selectedUser: item});
                        reset();
                    }

                    function moveSelection(step) {
                        var lastVisibleIndex = $scope.results.length;

                        if ($scope.results.length > LIST_LIMIT) {
                            lastVisibleIndex = LIST_LIMIT;
                        }
                        lastVisibleIndex--;


                        $scope.activeItem += step;

                        if ($scope.activeItem < 0) {
                            $scope.activeItem = lastVisibleIndex;
                        }
                        if ($scope.activeItem > lastVisibleIndex) {
                            $scope.activeItem = 0;
                        }
                    }


                }
            };
        });
})();
