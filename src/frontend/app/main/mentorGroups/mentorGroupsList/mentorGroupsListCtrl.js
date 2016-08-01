(function() {
    'use strict';

    angular
        .module('mentorGroups')
        .controller('mentorGroupsListCtrl', function($scope, apiService, userService, alerts) {
            $scope.list = [];            
            $scope.faculties = {
                list: [],
                selected: [],
                isChanged: false
            };
            $scope.campuses = {
                list: [],
                selected: [],
                isChanged: false
            };
            $scope.filterTerm = "";
            $scope.onDropHide = onDropHide;


        	getGroups();

            apiService.getFaculties(userService.getUnivInfo().id).then(
                function(response) {
                    if (response && response.length) {
                        $scope.faculties.list = response;
                    }
                }
            );
            apiService.getCampuses(userService.getUnivInfo().id).then(
                function(response) {
                    if (response && response.length) {
                        $scope.campuses.list = response;
                    }
                }
            );

            $scope.join = function(group) {
                apiService.mentorGroups.joinAsMentee(group.group_id).then(
                    function() {
                        group.is_joined = true;
                    },
                    function(response) {
                        alerts.warning(response.data.message);
                    }
                );
            };


            function getGroups() {
                $scope.loaderActive = true;
                apiService.mentorGroups.get($scope.filterTerm, $scope.faculties.selected, $scope.campuses.selected).then(
                    function(response) {
                        $scope.loaderActive = false;
                        if (response.groups && response.groups.length) {
                            $scope.list = response.groups;
                        } else {
                            $scope.list = [];
                        }
                    }
                );
            }

            $scope.$watch('filterTerm', function(newVal, oldVal) {
                if(newVal.length || oldVal.length) {
                    getGroups();
                }
            });

            function onDropHide() {
                if($scope.faculties.isChanged || $scope.campuses.isChanged) {
                    $scope.faculties.isChanged = false;
                    $scope.campuses.isChanged = false;
                    getGroups();
                }
            }
            

            



        });

})();
