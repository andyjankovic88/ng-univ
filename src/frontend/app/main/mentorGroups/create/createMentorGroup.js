(function() {
    'use strict';

    angular
        .module('mentorGroups')
        .controller('createMentorGroupCtrl', function($scope, apiService, userService, $state, alerts, $stateParams) {            
            var id = $stateParams.id;

            $scope.academicTopics = [];
            $scope.connections = [];
            $scope.selectedUsers = [];
            $scope.emails = [];


            $scope.group = {
            	name: '',
            	UnivProgramName: '',
            	UnivMentorProgramName: ''
            };


            if(id) {
                fillForm(id);
            }


            apiService.profile.info(userService.getInfo().id).then(
            	function(response) {
            		$scope.connections = response.connections;
            	},
            	function() {

            	}
            );

            $scope.onUserSelected = function(user) {
            	$scope.selectedUsers.push(user);
            };


            $scope.cancel = function() {
            	$state.go('mentorGroupsList');
            };
            $scope.create = function() {
            	var
            		group = $scope.group,
            		members = [];


            	if(group.name.length && group.UnivProgramName.length && group.UnivMentorProgramName.length) {
            		members = $scope.connections.concat($scope.selectedUsers);
            		apiService.mentorGroups.add(group.name, group.UnivProgramName, members).then(
            			function() {
            				alerts.warning('group created').closePromise.then(function() {
            					$state.go('mentorGroupsList');
            				});
            			},
            			function(response) {
            				alerts.warning(response.statusText + ', code: ' + response.status).closePromise.then(function() {
            					$state.go('mentorGroupsList');
            				});
            			}
        			);
            	}
            };

            function fillForm(id) {
                apiService.mentorGroups.formData(id).then(
                    function(response) {
                        $scope.selectedUsers = response.group_members;
                        $scope.group.name = response.group_name;
                        $scope.group.UnivMentorProgramName = response.program_name;
                    }
                );
            }

        });

})();
