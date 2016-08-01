(function() {
    'use strict';

    var LIST_LIMIT = 10;

    angular
        .module('mentorGroups')
        .directive('mentorsSearch', function(apiService) {
            return {
                restrict: 'E',
                scope: {
                    filterTerm: '='
                },
                templateUrl: '/app/main/mentorGroups/mentorGroupsList/mentorsSearch/mentorsSearch.html',
                link: function($scope, $element) {
                    var
                        hasDeferredSearch = false,
                        justSelected = false,
                        $inputEl = $element.find('input');

                    


                    reset();

                    $scope.search = function() {
                        if ($scope.loading) {
                            hasDeferredSearch = true;
                            return;
                        }                        
                        if(justSelected) {
                           justSelected = false;
                           return;
                        }
                        $scope.filterMode = false;

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
                    $scope.reset = reset;
                    $scope.select = select;

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
                        $scope.isTermQueried = false;
                        $scope.loading = false;
                        $scope.results = [];
                        $scope.listNavigation = false;
                        $scope.activeItem = -1;
                        $scope.listLimit = LIST_LIMIT;
                        $scope.filterMode = false;
                        $scope.filterTerm = "";
                        $inputEl.focus();
                    }

                    function select($index, item) {
                        $scope.activeItem = $index;
                        $scope.searchTerm = item.value;
                        $scope.filterMode = true;
                        $scope.filterTerm = $scope.searchTerm;
                        justSelected = true;
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
